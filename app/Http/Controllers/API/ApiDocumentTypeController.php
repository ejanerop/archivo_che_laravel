<?php

namespace App\Http\Controllers\API;

use App\DocumentType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ResourceType;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ApiDocumentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DocumentType::withCount('documents')->get();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validate = $request->validate([
            'document_type' => 'required|unique:document_types'
        ]);

        $resource_type = ResourceType::where('resource_type', $request->input('resource_type'))->first();

        $documentType = new DocumentType();
        $documentType->document_type = $request->input('document_type');
        $documentType->resource_type()->associate($resource_type);
        $documentType->save();

        //Logger::log('create', 'document_type', $documentType->id, $documentType->document_type);

        return response()->json('Tipo de documento creado correctamente.', 201);

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\DocumentType  $documentType
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, DocumentType $documentType)
    {
        //todo
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

        //Logger::log('update', 'document_type', $documentType->id, $documentType->document_type);

        return response()->json('Tipo de documento editado correctamente.', 204);

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
            return response()->json('No se puede eliminar. Existen documentos de este tipo.', 422);//TODO codigo
        }else{
            $name = $documentType->document_type;
            $documentType->delete();

            //Logger::log('delete', 'document_type', $documentType->id, $name);

            return response()->json('Eliminado correctamente', 204);
        }

    }
}
