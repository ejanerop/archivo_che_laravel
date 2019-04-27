<?php

namespace App\Http\Controllers;

use App\DocumentType;
use App\ResourceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DocumentTypeController extends Controller
{
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
            'document_type' => 'required|unique:document_type'
        ]);

        $document_type = new DocumentType();
        $document_type->document_type = $request->input('document_type');
        $document_type->resource_type()->associate($resource_type);
        $document_type->save();
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
            'document_type' => ['required', Rule::unique('document_type')->ignore($documentType->id)]
        ])->validate();

        $resource_type = ResourceType::where('resource_type', $request->input('resource_type'))->first();

        $documentType->document_type = $request->input('document_type');
        $documentType->resource_type()->associate($resource_type);
        $documentType->save();
        return redirect()->route('document_type.index', ['document_types' => DocumentType::all()]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DocumentType $documentType
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(DocumentType $documentType)
    {
        if($documentType->documents()->count() != 0){
            return redirect()->route('document_type.index', ['document_types' => DocumentType::all()])->with('error', 'No se puede eliminar. Existen documentos de este tipo.');
        }else{
            $documentType->delete();
            return redirect()->route('document_type.index', ['document_types' => DocumentType::all()])->with('success', 'Eliminado correctamente');

        }


    }
}
