<?php

namespace App\Http\Controllers\API;

use App\Author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Util\Logger;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ApiAuthorController extends Controller
{
    public function __construct()
    {
        $this->middleware('cors');
    }

    /**
     * Returns a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //TO-DO
        return Author::all();
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
            'name' => 'required|unique:authors',
            'description' => 'nullable|max:255'
        ]);
        $author = new Author();
        $author->name = $request->input('name');
        $author->description = $request->input('description');
        $author->save();

        //Logger::log('create', 'author', $author->id, $author->name);

        return response()->json('Creado correctamente', 204);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ResearchTopic  $researchTopic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        $validate = Validator::make($request->all(),[
            'name' => ['required', Rule::unique('authors')->ignore($author->id)],
            'description' => ['nullable', 'max:255']
        ])->validate();


        $author->name = $request->input('name');
        $author->description = $request->input('description');
        $author->save();

        //Logger::log('update', 'author', $author->id, $author->name);

        return response()->json('Actualizado correctamente', 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ResearchTopic $researchTopic
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Author $author)
    {
        if($author->documents()->count() != 0){
            return response('No se puede eliminar, existen documentos pertenecientes a este autor.', 409);
        }else{
            $name = $author->name;
            $author->delete();

            Logger::log('delete', 'author', $author->id, $name);

            return response()->json('Eliminado correctamente', 204);
        }
    }

}
