<?php

namespace App\Http\Controllers;

use App\AccessLevel;
use App\Document;
use App\DocumentType;
use App\ResearchTopic;
use App\Resource;
use App\ResourceType;
use App\Rules\DateString;
use App\Subtopic;
use App\Text;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
        return view('document.index', ['documents' => Document::with(['subtopics', 'resources', 'access_level','document_type'])->get()]);
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
            'name' => 'required',
            'subtopics' => 'required',
            'date' =>['required' , new DateString()],
            'facsim' => 'required_with:hasFacsim|mimetypes:image/*',
            'resource' => 'required_unless:type,text|mimetypes:video/*,audio/*,image/*'
        ])->validate();


        $accessLevel = AccessLevel::where('name', $request->input('access_level'))->first();
        $documentType = DocumentType::where('document_type', $request->input('document_type'))->first();
        $subtopics = $request->input('subtopics');
        $resource = new Resource();

        $document = new Document();
        $document->name = $request->input('name');
        $document->date = date('Y-m-d', strtotime($request->input('date')));
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
            $text = new Text();
            $text->text = $request->input('text');
            $text->save();
            $resource->type = 'text';
            $resource->text()->associate($text);
            $resource->save();
            if($request->hasFile('facsim')){
                $pathFacsim = $request->file('facsim')->store('public');
                $facsim = new Resource();
                $facsim->type = 'facsim';
                $facsim->src = $pathFacsim;
                $facsim->document()->associate($document);
                $facsim->save();
            }
        }else{
            $path = $request->file('resource')->store('public');
            $resource->src = $path;
            $resource->description = $request->input('resource_description');
        }
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
        $document->load('subtopics', 'resources', 'access_level','document_type');
        return view('document.show',['document' => $document]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('document.edit', ['document'=> Document::with(['subtopics', 'resources', 'access_level','document_type'])->find($id),
            'resource_types' => ResourceType::with('document_types')->get(),
            'topics' => ResearchTopic::with('subtopics')->get(),
            'access_levels' => AccessLevel::all()]);
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
        //todo
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //TODO
        echo 'TO-DO Borrar';
    }

    public function test(Request $request)
    {
        return $request;
    }
}
