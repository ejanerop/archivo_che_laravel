<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;
use App\Util\Logger;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AuthorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('author.index', ['authors'=> Author::withCount('documents')->get()]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('author.create');
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

        Logger::log('create', 'author', $author->id, $author->name);

        return redirect()->route('author.index')->with('success', 'Autor registrado correctamente.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\ResearchTopic  $researchTopic
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        return view('author.show', ['author' => $author]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ResearchTopic  $researchTopic
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        return view('author.edit', ['author' => $author]);
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

        Logger::log('update', 'author', $author->id, $author->name);

        return redirect()->route('author.index', ['authors'=> Author::all()]);
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
            return redirect()->route('author.index', ['authors'=> Author::all()])->with('error', 'No se puede eliminar, existen documentos pertenecientes a este autor.');
        }else{
            $name = $author->name;
            $author->delete();

            Logger::log('delete', 'author', $author->id, $name);

            return redirect()->route('research_topic.index', ['authors'=> Author::all()])->with('success', 'Eliminado correctamente el autor' . $name);
        }
    }

}
