<?php

namespace App\Http\Controllers;

use App\DocumentType;
use App\ResourceType;
use Illuminate\Http\Request;

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

        $document_type = new DocumentType();
        $document_type->document_type = $request->input('document_type');
        $document_type->resource_type()->associate($resource_type);
        $document_type->save();
        return view('document_type.index', ['document_types' => DocumentType::all()]);
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
        //todo
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DocumentType  $documentType
     * @return \Illuminate\Http\Response
     */
    public function destroy(DocumentType $documentType)
    {
        //TODO Que no tenga documentos aputando a el
        //TODO Confirmación
        $documentType->delete();

        return view('document_type.index', ['document_types' => DocumentType::all()]);
    }
}
