<?php

namespace App\Http\Controllers;

use App\AccessLevel;
use App\Document;
use App\DocumentType;
use App\ResearchTopic;
use App\Resource;
use App\ResourceType;
use App\Rules\DateString;
use App\Rules\DateNow;
use App\Subtopic;
use App\Text;
use App\Stage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use phpDocumentor\Reflection\File;
use App\Util\Logger;

class DocumentController extends Controller
{

    public function __construct() {
        $this->middleware('user.has.role:manager');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $documents = Document::with(['subtopics', 'resources', 'access_level','document_type'])->paginate(50);
        return view('document.index', ['documents' => $documents,
                                       'resource_types' => ResourceType::with('document_types')->get(),
                                       'topics' => ResearchTopic::with('subtopics')->get(),
                                       'stages' => Stage::all(),
                                       'filtered' => false]);
    }

    public function filter(Request $request)
    {

        $documents = Document::with(['subtopics', 'resources', 'access_level','document_type']);

        //TODO add si no hay filtro, redirect index
        $filtered = false;

        if ($request->has('nameFilter')) {
            $name = $request->input('nameFilter');
            if (trim($name) != '') {
                $documents->filterName($name);
                $filtered = true;
            }
        }
        if ($request->has('document_typesFilter')) {
            $document_types = $request->input('document_typesFilter');
            $documents->filterTypes($document_types);
            $filtered = true;
        }
        if ($request->has('stagesFilter')) {
            $stages = $request->input('stagesFilter');
            $documents->filterStages($stages);
            $filtered = true;
        }
        if ($request->has('subtopicsFilter')) {
            $subtopic = $request->input('subtopicsFilter');
            $documents->filterSubtopics($subtopic);
            $filtered = true;
        }
        if ($request->has('dateStartFilter')) {
            if ($request->has('dateEndFilter')) {
                $documents->filterSubtopics($subtopic);
            $filtered = true;
            }
        }


        return view('document.index', ['documents' => $documents->paginate(50),
                                       'resource_types' => ResourceType::with('document_types')->get(),
                                       'topics' => ResearchTopic::with('subtopics')->get(),
                                       'stages' => Stage::all(),
                                       'filtered' => $filtered]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('document.create', [
            'resource_types' => ResourceType::with('document_types')->get(),
            'topics' => ResearchTopic::with('subtopics')->get(),
            'access_levels' => AccessLevel::all()
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
            'author' => 'required',
            'date' =>['required' , new DateString(), new DateNow()],
            'facsim' => 'required_with:hasFacsim',
            'resource' => 'mimetypes:video/*,audio/*,image/*,application/pdf'
        ])->validate();


        $accessLevel = AccessLevel::where('name', $request->input('access_level'))->first();
        $documentType = DocumentType::where('document_type', $request->input('document_type'))->first();
        $subtopics = $request->input('subtopics');
        $resource = new Resource();


        $document = new Document();
        $document->name = $request->input('name');
        $document->author = $request->input('author');

        $date = date('Y-m-d', strtotime($request->input('date')));
        $document->date = $date;
        $stages = Stage::all();
        foreach ($stages as $stage) {
            if (($date >= $stage->date_start) && ($date <= $stage->date_end)) {
                $document->stage()->associate($stage);
            }
        }

        $document->access_level()->associate($accessLevel);
        $document->document_type()->associate($documentType);
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
                $pathFacsim = Storage::disk('public')->putFile('facsim', $request->file('facsim'));
                $facsim = new Resource();
                $facsim->type = 'facsim';
                $facsim->src = $pathFacsim;
                $facsim->document()->associate($document);
                $facsim->save();
            }
        }
        $path = Storage::disk('public')->putFile($type, $request->file('resource'));;
        $resource->src = $path;
        $resource->description = $request->input('resource_description');
        $resource->save();


        return redirect()->route('document.index')->with('success','El documento fue creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $document = Document::find($id);
        $mainResource = null;
        foreach ($document->resources as $resource){
            if($resource->type != 'facsim'){
                $mainResource = $resource;
            }
        }
        $document->load('subtopics', 'resources', 'access_level','document_type', 'document_type.resource_type');
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
        $text = null;
        foreach ($document->resources as $res){
            if($res->type == 'text'){
                $text = $res->text;
            }
        }
        $resource = Resource::with('text')->where('type','<>','facsim')->first();
        $subtopics = [];
        $i = 0;
        foreach ($document->subtopics as $subtopic){
            $subtopics[$i] = $subtopic->id;
        }
        return view('document.edit', ['document'=> Document::with(['subtopics', 'resources', 'access_level','document_type'])->find($id),
            'resource_types' => ResourceType::with('document_types')->get(),
            'topics' => ResearchTopic::with('subtopics')->get(),
            'access_levels' => AccessLevel::all(),
            'subtopics' => $subtopics,
            'text' => $text]);
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
            'date' =>['required' , new DateString(), new DateNow()],
            'facsim' => 'required_with:hasFacsim|mimetypes:image/*',
            'resource' => 'mimetypes:video/*,audio/*,image/*'
        ])->validate();


        $document = Document::find($id);
        $accessLevel = AccessLevel::where('name', $request->input('access_level'))->first();
        $documentType = DocumentType::where('document_type', $request->input('document_type'))->first();
        $subtopics = $request->input('subtopics');


        $document->name = $request->input('name');
        $document->date = date('Y-m-d', strtotime($request->input('date')));
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

        $document->document_type()->dissociate();
        $document->document_type()->associate($documentType);

        $resource = new Resource();

        if($request->hasFile('resource')){
            foreach($document->resources as $res){
                if($res->type != 'facsim'){
                    Storage::disk('public')->delete($res->src);
                    $res->delete();
                }
            }
            $type = $request->input('type');
            $path = Storage::disk('public')->putFile($type, $request->file('resource'));;
            $resource->src = $path;
            $resource->description = $request->input('resource_description');
            $resource->type = $request->input('type');
            $resource->document()->associate($document);
            $resource->save();
        }

        $type = $request->input('type');
        if($type == 'text'){
            foreach($document->resources as $res){
                if($res->type == 'text'){
                    $txt = $res->text;
                    $res->delete();
                    $txt->delete();
                }
            }
            $text = new Text();
            $text->text = $request->input('text');
            $text->save();
            $resource->type = 'text';

            $resource->text()->associate($text);
            $resource->document()->associate($document);
            $resource->save();
            if($request->hasFile('facsim')){
                $pathFacsim = Storage::disk('public')->putFile('facsim', $request->file('facsim'));
                $facsim = new Resource();
                $facsim->type = 'facsim';
                $facsim->src = $pathFacsim;
                $facsim->document()->associate($document);
                $facsim->save();
            }
        }

        $document->save();

        return redirect()->route('document.index')->with('success','El documento fue editado correctamente.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $document = Document::with('resources')->find($id);
        $document->subtopics()->detach();
        foreach($document->resources as $resource){
            if($resource->type == 'text'){
                $id = $resource->text->id;
                $resource->text()->dissociate();
                $text = Text::find($id);
                $resource->delete();
                $text->delete();
            }else{
                Storage::disk('public')->delete($resource->src);
                $resource->delete();
            }
        }
        $document->delete();
        return redirect()->route('document.index')->with('success','El documento fue eliminado correctamente.');

    }

    public function test(Request $request)
    {
        return $request;
    }
}
