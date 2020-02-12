<?php

namespace App\Http\Controllers;

use App\ResearchTopic;
use App\Subtopic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Util\Logger;

class SubtopicController extends Controller
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
        return view('subtopic.index', ['subtopics' => Subtopic::with('research_topic')->withCount('documents')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subtopic.create', ['research_topics'=>ResearchTopic::get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $research_topic = ResearchTopic::where('research_topic', $request->input('research_topic'))->first();

        $validate = $request->validate([
            'name' => 'required|string|unique:subtopics',
            'description' => 'nullable|string'
        ]);

        $subtopic = new Subtopic();
        $subtopic->name = $request->input('name');
        $subtopic->description = $request->input('description');
        $subtopic->research_topic()->associate($research_topic);
        $subtopic->save();

        Logger::log('create', $request->ip(), 'subtopic', $subtopic->id);

        return redirect()->route('subtopic.index')->with('success','El subtema fue creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //todo
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('subtopic.edit', ['subtopic'=>Subtopic::find($id), 'research_topics'=>ResearchTopic::get()]);
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

        $validate = Validator::make($request->all(),[
            'name' => ['required', 'string', Rule::unique('subtopics')->ignore($id)],
            'description' => ['nullable','string']
        ])->validate();

        $research_topic = ResearchTopic::where('research_topic', $request->input('research_topic'))->first();

        $subtopic = Subtopic::find($id);
        $subtopic->name = $request->input('name');
        $subtopic->description = $request->input('description');
        $subtopic->research_topic()->associate($research_topic);
        $subtopic->save();

        Logger::log('edit', $request->ip(), 'subtopic', $subtopic->id);

        return redirect()->route('subtopic.index')->with('success','El subtema fue editado correctamente.');;
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

        $subtopic = Subtopic::with('documents')->find($id);
        if($subtopic->documents()->count() != 0){
            return redirect()->route('subtopic.index', ['subtopics' => Subtopic::with('research_topic')->get()])->with('error', 'No se puede eliminar, existen documentos pertenecientes a este tema.');
        }else{
            $subtopic->delete();
            Logger::log('delete', $request->ip(), 'subtopic', $subtopic->id);
            return redirect()->route('subtopic.index', ['subtopics' => Subtopic::with('research_topic')->get()])->with('success', 'Eliminado correctamente');

        }
    }
}
