<?php

namespace App\Http\Controllers;

use App\DocumentType;
use App\ResourceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Util\Logger;

class DocumentTypeController extends Controller
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
        return view('document_type.index', ['document_types' => DocumentType::withCount('documents')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('document_type.create', ['resource_types' => ResourceType::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $resource_type = ResourceType::where('resource_type', $request->input('resource_type'))->first();

        $validate = $request->validate([
            'document_type' => 'required|unique:document_types'
        ]);

        $documentType = new DocumentType();
        $documentType->document_type = $request->input('document_type');
        $documentType->resource_type()->associate($resource_type);
        $documentType->save();

        Logger::log('create', $request->ip(), 'document_types', $documentType->id, $documentType->document_type);

        return redirect()->route('document_type.index')->with('success', 'Tipo de documento creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DocumentType  $documentType
     * @return \Illuminate\Http\Response
     */
    public function show(DocumentType $documentType)
    {
        //todo
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DocumentType  $documentType
     * @return \Illuminate\Http\Response
     */
    public function edit(DocumentType $documentType)
    {
        return view('document_type.edit',['document_type' => $documentType, 'resource_types' => ResourceType::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DocumentType  $documentType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DocumentType $documentType)
    {

        $validate = Validator::make($request->all(),[
            'document_type' => ['required', Rule::unique('document_types')->ignore($documentType->id)]
        ])->validate();

        $resource_type = ResourceType::where('resource_type', $request->input('resource_type'))->first();

        $documentType->document_type = $request->input('document_type');
        $documentType->resource_type()->associate($resource_type);
        $documentType->save();

        Logger::log('update', $request->ip(), 'document_types', $documentType->id, $documentType->document_type);

        return redirect()->route('document_type.index', ['document_types' => DocumentType::all()])->with('success', 'Tipo de documento editado correctamente.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DocumentType $documentType
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Request $request, DocumentType $documentType)
    {
        if($documentType->documents()->count() != 0){
            return redirect()->route('document_type.index', ['document_types' => DocumentType::all()])->with('error', 'No se puede eliminar. Existen documentos de este tipo.');
        }else{
            $name = $documentType->document_type;
            $documentType->delete();

            Logger::log('delete', $request->ip(), 'document_types', $documentType->id, $name);

            return redirect()->route('document_type.index', ['document_types' => DocumentType::all()])->with('success', 'Eliminado correctamente');

        }


    }
}
