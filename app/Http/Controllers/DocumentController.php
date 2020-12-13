<?php

namespace App\Http\Controllers;

use App\AccessLevel;
use App\Author;
use App\CustomDate;
use App\DateType;
use App\Document;
use App\DocumentType;
use App\ResearchTopic;
use App\Resource;
use App\ResourceType;
use App\Rules\DateString;
use App\Rules\DateNow;
use App\Subtopic;
use App\Stage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Util\Logger;
use \Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user.has.role:manager')->except(['index','show', 'filter']);
        $this->middleware('user.has.access')->only('show');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->canSeeAll()) {
            $documents = Document::all();
        } else {
            $documents = Document::with(['subtopics', 'resources', 'access_level','document_type'])->filterAccessLevel(Auth::user()->level)->get();
            $documentsAllowed = Auth::user()->approved_documents;
            $documents = $documents->merge($documentsAllowed);
        }

        return view('document.index', ['documents' => $documents->paginate(100),
                                       'resource_types' => ResourceType::with('document_types')->get(),
                                       'topics' => ResearchTopic::with('subtopics')->get(),
                                       'authors' => Author::all(),
                                       'stages' => Stage::all(),
                                       'filtered' => false]);
    }


    /**
     * Display a listing of the resource filtered.
     *
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'dateStartFilter' =>['nullable', new DateString(), new DateNow()],
            'dateEndFilter' =>['nullable', new DateString(), new DateNow()]
        ])->validate();

        $documents = Document::with(['subtopics', 'resources', 'access_level','document_type'])->filterAccessLevel(Auth::user()->level);
        $documentsAllowed = Auth::user()->approved_documents;




        $filtered = false;

        if ($request->has('nameFilter')) {
            $name = $request->input('nameFilter');
            if (trim($name) != '') {
                $documents->filterName($name);
                $documentsAllowed = $documentsAllowed->where('name', 'like', '%'. $name .'%');
                $filtered = true;
            }
        }
        if ($request->has('authorsFilter')) {
            $authors = $request->input('authorsFilter');
            $documents->filterAuthors($authors);
            $documentsAllowed = $documentsAllowed->filter(function($item) use($authors){
                return  in_array($item->author->name, $authors);
            });
            $filtered = true;
        }
        if ($request->has('document_typesFilter')) {
            $document_types = $request->input('document_typesFilter');
            $documents->filterTypes($document_types);
            $documentsAllowed = $documentsAllowed->filter(function($item) use($document_types){
                return  in_array($item->document_type->document_type, $document_types);
            });
            $filtered = true;
        }
        if ($request->has('subtopicsFilter')) {
            $subtopics = $request->input('subtopicsFilter');
            $documents->filterSubtopics($subtopics);
            $documentsAllowed = $documentsAllowed->filter(function($item) use($subtopics){
                $return = false;
                foreach ($item->subtopics as $topic) {
                    if (in_array($topic->name, $subtopics)) {
                        $return = true;
                    }
                }
                return $return;
            });
            $filtered = true;
        }
        if ($request->has('stagesFilter')) {
            $stages = $request->input('stagesFilter');
            $documents->filterStages($stages);
            $documentsAllowed = $documentsAllowed->filter(function($item) use($stages){
                return  in_array($item->stage->name, $stages);
            });
            $filtered = true;
        }else{
            if ($request->has('dateStartFilter')) {
                if (trim($request->input('dateStartFilter')) != '') {
                    $date = strtotime($request->input('dateStartFilter'));
                    $documents->filterDateStart(date('Y-m-d', $date));
                    $documentsAllowed = $documentsAllowed->where('date', '>=', date('Y-m-d', $date));
                    $filtered = true;
                }
            }
            if ($request->has('dateEndFilter')) {
                if (trim($request->input('dateEndFilter')) != '') {
                    $date = strtotime($request->input('dateEndFilter'));
                    $documents->filterDateEnd(date('Y-m-d', $date));
                    $documentsAllowed = $documentsAllowed->where('date', '<=', date('Y-m-d', $date));
                    $filtered = true;
                }
            }
        }

        $result = $documents->get()->merge($documentsAllowed);

        if ($filtered) {
            return view('document.index', ['documents' => $result->paginate(50),
                                           'resource_types' => ResourceType::with('document_types')->get(),
                                           'topics' => ResearchTopic::with('subtopics')->get(),
                                           'authors' => Author::all(),
                                           'stages' => Stage::all(),
                                           'filtered' => $filtered]);
        }else{
            return redirect()->route('document.index');
        }

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accessLevels = AccessLevel::where('level','<>', 1)->get();

        return view('document.create', [
            'resource_types' => ResourceType::with('document_types')->get(),
            'topics' => ResearchTopic::with('subtopics')->get(),
            'access_levels' => $accessLevels,
            'authors' => Author::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:documents',
            'subtopics' => 'required',
            'description' => 'required',
            'author' => 'required',
            'access_level' => 'required',
            'document_type' => 'required',
            'date_type' => 'required',
            'yearStart' => 'required',
            'monthStart' => 'required_if:date_type,month_year,full_date',
            'dayStart' => 'required_if:date_type,full_date',
            'yearEnd' => 'required_if:date_type,lapse,year_lapse',
            'monthEnd' => 'required_if:date_type,lapse',
            'facsim' => 'required_with:hasFacsim',
            'resource' => 'required|mimetypes:video/*,audio/*,image/*,application/pdf'
        ])->validate();


        $accessLevel = AccessLevel::where('name', $request->input('access_level'))->first();
        $documentType = DocumentType::where('document_type', $request->input('document_type'))->first();
        $author = Author::where('name', $request->input('author'))->first();
        $subtopics = $request->input('subtopics');
        $resource = new Resource();
        $code = '';


        $document = new Document();
        $document->name = $request->input('name');

        //-------------------Fecha----------------------------------------------------------------------------------

        $customDate = new CustomDate();
        $dateType = DateType::where('slug', $request->input('date_type'))->first();
        $customDate->date_type()->associate($dateType);

        if ($dateType->slug == 'full_date') {
            $customDate->dayStart = $request->input('dayStart');
            $customDate->monthStart = $request->input('monthStart');
            $customDate->yearStart = $request->input('yearStart');
        } else if ($dateType->slug == 'month_year') {
            $customDate->monthStart = $request->input('monthStart');
            $customDate->yearStart = $request->input('yearStart');
        } else if ($dateType->slug == 'year') {
            $customDate->yearStart = $request->input('yearStart');
        } else if ($dateType->slug == 'lapse') {
            if ($request->has('dayStart')) { $customDate->dayStart = $request->input('dayStart');}
            $customDate->monthStart = $request->input('monthStart');
            $customDate->yearStart = $request->input('yearStart');
            if ($request->has('dayEnd')) { $customDate->dayEnd = $request->input('dayEnd');}
            $customDate->monthEnd = $request->input('monthEnd');
            $customDate->yearEnd = $request->input('yearEnd');
        }else {
            $customDate->yearStart = $request->input('yearStart');
            $customDate->yearEnd = $request->input('yearEnd');
        }

        $customDate->save();

        //--------------Etapa---------------------------------------------------------------------------------------

        $stages = Stage::all();
        foreach ($stages as $stage) {
            if (($customDate->dateStart >= $stage->date_start) && ($customDate->dateStart <= $stage->date_end)) {
                $document->stage()->associate($stage);
                if ($stage->id == 1) {
                    $code = 'NA';
                }elseif ($stage->id == 2) {
                    $code = 'PJ';
                }elseif ($stage->id == 3) {
                    $code = 'AJ';
                }elseif ($stage->id == 4) {
                    $code = 'AD';
                }else {
                    $code = 'PM';
                }
            }
        }


        $code .= substr($customDate->dateStart, 2, 2);

        do {
            $number = rand(1, 999);
            if (($number >= 1) && ($number < 10)) {
                $code .= '-00' . $number;
            }elseif (($number >= 10) && ($number < 100)) {
                $code .= '-0' . $number;
            }else {
                $code .= '-' . $number;
            }

            $document->code = $code;
        } while (Document::where('code', $code)->exists());


        $document->access_level()->associate($accessLevel);
        $document->document_type()->associate($documentType);
        $document->author()->associate($author);
        $document->custom_date()->associate($customDate);

        if($request->has('description')){
            $document->description = $request->input('description');
        }

        $document->save();
        foreach ($subtopics as $topic){
            $subtopic = Subtopic::where('name', $topic)->first();
            $document->subtopics()->attach($subtopic);
        }
        $resource->document()->associate($document);
        $resource->type = $request->input('type');
        $type = $request->input('type');
        if($type == 'text'){
            if($request->hasFile('facsim')){
                foreach ($request->file('facsim') as $facsimFile) {
                    $pathFacsim = Storage::disk('media')->putFile('facsim', $facsimFile);
                    $pathFacsim = str_replace('/', '\\', $pathFacsim);
                    $facsim = new Resource();
                    $facsim->type = 'facsim';
                    $facsim->src = $pathFacsim;
                    $facsim->document()->associate($document);
                    $facsim->save();
                }
            }
        }
        $path = Storage::disk('media')->putFile($type, $request->file('resource'));
        $path = str_replace('/', '\\', $path);
        $resource->src = $path;
        $resource->description = $request->input('resource_description');
        $resource->save();

        Logger::log('create', 'document', $document->id, $document->name);

        return redirect()->route('document.index')->with('success','El documento fue creado correctamente.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $document = Document::find($id);
        $mainResource = null;
        foreach ($document->resources as $resource){
            if($resource->type != 'facsim'){
                $mainResource = $resource;
            }
        }
        $document->load('subtopics', 'resources', 'author', 'access_level','document_type', 'document_type.resource_type');

        Logger::log('read', 'document', $document->id, $document->name);

        return view('document.show',['document' => $document, 'mainResource' => $mainResource]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $document = Document::with('subtopics')->find($id);
        $resource = Resource::where('type','<>','facsim')->first();
        $subtopics = [];
        $i = 0;
        foreach ($document->subtopics as $subtopic){
            $subtopics[$i] = $subtopic->id;
        }
        $accessLevels = AccessLevel::where('level','<>', 1)->get();
        return view('document.edit', ['document'=> Document::with(['subtopics', 'resources', 'access_level','document_type'])->find($id),
            'resource_types' => ResourceType::with('document_types')->get(),
            'authors' => Author::all(),
            'topics' => ResearchTopic::with('subtopics')->get(),
            'access_levels' => $accessLevels,
            'subtopics' => $subtopics]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => ['required',  Rule::unique('documents')->ignore($id)],
            'subtopics' => 'required',
            'author' => 'required',
            'description' => 'required',
            'date_type' => 'required',
            'yearStart' => 'required',
            'monthStart' => 'required_if:date_type,month_year,full_date',
            'dayStart' => 'required_if:date_type,full_date',
            'yearEnd' => 'required_if:date_type,lapse,year_lapse',
            'monthEnd' => 'required_if:date_type,lapse',
            'facsim' => 'required_with:hasFacsim|mimetypes:image/*',
            'resource' => 'mimetypes:video/*,audio/*,image/*,application/pdf'
        ])->validate();


        $document = Document::find($id);
        $accessLevel = AccessLevel::where('name', $request->input('access_level'))->first();
        $documentType = DocumentType::where('document_type', $request->input('document_type'))->first();
        $author = Author::where('name', $request->input('author'))->first();
        $dateType = DateType::where('slug', $request->input('date_type'))->first();
        $customDate = $document->custom_date;
        $subtopics = $request->input('subtopics');

        $dateType = DateType::where('slug', $request->input('date_type'))->first();
        $customDate->date_type()->dissociate();
        $customDate->date_type()->associate($dateType);

        if ($dateType->slug == 'full_date') {
            $customDate->dayStart = $request->input('dayStart');
            $customDate->monthStart = $request->input('monthStart');
            $customDate->yearStart = $request->input('yearStart');
        } else if ($dateType->slug == 'month_year') {
            $customDate->monthStart = $request->input('monthStart');
            $customDate->yearStart = $request->input('yearStart');
        } else if ($dateType->slug == 'year') {
            $customDate->yearStart = $request->input('yearStart');
        } else if ($dateType->slug == 'lapse') {
            if ($request->has('dayStart')) { $customDate->dayStart = $request->input('dayStart');}
            $customDate->monthStart = $request->input('monthStart');
            $customDate->yearStart = $request->input('yearStart');
            if ($request->has('dayEnd')) { $customDate->dayEnd = $request->input('dayEnd');}
            $customDate->monthEnd = $request->input('monthEnd');
            $customDate->yearEnd = $request->input('yearEnd');
        }else {
            $customDate->yearStart = $request->input('yearStart');
            $customDate->yearEnd = $request->input('yearEnd');
        }

        $customDate->save();

        $stages = Stage::all();
        $document->stage()->dissociate();
        foreach ($stages as $stage) {
            if (($customDate->dateStart >= $stage->date_start) && ($customDate->dateStart <= $stage->date_end)) {
                $document->stage()->associate($stage);
                if ($stage->id == 1) {
                    $code = 'NA';
                }elseif ($stage->id == 2) {
                    $code = 'PJ';
                }elseif ($stage->id == 3) {
                    $code = 'AJ';
                }elseif ($stage->id == 4) {
                    $code = 'AD';
                }else {
                    $code = 'PM';
                }
            }
        }


        $document->name = $request->input('name');
        if($request->has('description')){
            $document->description = $request->input('description');
        }else{
            $document->description = '';
        }

        $document->subtopics()->detach();
        foreach ($subtopics as $topic){
            $subtopic = Subtopic::where('name', $topic)->first();
            $document->subtopics()->attach($subtopic);
        }

        $document->access_level()->dissociate();
        $document->access_level()->associate($accessLevel);

        $document->author()->dissociate();
        $document->author()->associate($author);

        $document->document_type()->dissociate();
        $document->document_type()->associate($documentType);

        $resource = new Resource();

        if($request->hasFile('resource')){
            foreach($document->resources as $res){
                if($res->type != 'facsim'){
                    $pathToDelete = str_replace('\\', '/', $res->src);
                    Storage::disk('media')->delete($pathToDelete);
                    $res->delete();
                }
            }
            $type = $request->input('type');
            $path = Storage::disk('media')->putFile($type, $request->file('resource'));
            $path = str_replace('/', '\\', $path);
            $resource->src = $path;
            $resource->description = $request->input('resource_description');
            $resource->type = $request->input('type');
            $resource->document()->associate($document);
            $resource->save();
        }

        $type = $request->input('type');

        if($request->hasFile('facsim')){
            $pathFacsim = Storage::disk('media')->putFile('facsim', $request->file('facsim'));
            $pathFacsim = str_replace('/', '\\', $path);
            $facsim = new Resource();
            $facsim->type = 'facsim';
            $facsim->src = $pathFacsim;
            $facsim->document()->associate($document);
            $facsim->save();
        }

        $document->save();

        Logger::log('update', 'document', $document->id, $document->name);

        return redirect()->route('document.index')->with('success','El documento fue editado correctamente.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Request $request, $id)
    {
        $document = Document::with('resources')->find($id);
        $document->subtopics()->detach();
        foreach($document->resources as $resource){
            $pathToDelete = str_replace('\\', '/', $resource->src);
            Storage::disk('media')->delete($pathToDelete);
            $resource->delete();
        }
        $document->custom_date->delete();
        $document->delete();

        Logger::log('delete', 'document', $document->id, $document->name);

        return redirect()->route('document.index')->with('success','El documento fue eliminado correctamente.');

    }

    public function test(Request $request)
    {
        return $request;
    }
}
