<?php

namespace App\Http\Controllers;

use App\ResearchTopic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Util\Logger;

class ResearchTopicController extends Controller
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
        return view('research_topic.index', ['research_topics'=> ResearchTopic::with('subtopics')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('research_topic.create');
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
            'research_topic' => 'required|unique:research_topic',
            'description' => 'nullable|max:255'
        ]);
        $researchTopic = new ResearchTopic();
        $researchTopic->research_topic = $request->input('research_topic');
        $researchTopic->description = $request->input('description');
        $researchTopic->save();

        Logger::log('create', $request->ip(), 'research_topic', $researchTopic->id);

        return redirect()->route('research_topic.index')->with('success', 'Tema de investigación creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ResearchTopic  $researchTopic
     * @return \Illuminate\Http\Response
     */
    public function show(ResearchTopic $researchTopic)
    {
        //todo
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ResearchTopic  $researchTopic
     * @return \Illuminate\Http\Response
     */
    public function edit(ResearchTopic $researchTopic)
    {
        return view('research_topic.edit', ['research_topic' => $researchTopic]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ResearchTopic  $researchTopic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResearchTopic $researchTopic)
    {
        $validate = Validator::make($request->all(),[
            'research_topic' => ['required', Rule::unique('research_topic')->ignore($researchTopic->id)],
            'description' => ['nullable', 'max:255']
        ])->validate();

        $researchTopic->research_topic = $request->input('research_topic');
        $researchTopic->description = $request->input('description');
        $researchTopic->save();

        Logger::log('update', $request->ip(), 'research_topic', $researchTopic->id);

        return redirect()->route('research_topic.index', ['research_topics'=> ResearchTopic::withCount('subtopics')->get()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ResearchTopic $researchTopic
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Request $request, ResearchTopic $researchTopic)
    {

        if($researchTopic->subtopics()->count() != 0){
            return redirect()->route('research_topic.index', ['research_topics'=> ResearchTopic::withCount('subtopics')->get()])->with('error', 'No se puede eliminar, existen subtemas pertenecientes a este tema.');
        }else{
            $researchTopic->delete();
            Logger::log('delete', $request->ip(), 'research_topic', $researchTopic->id);
            return redirect()->route('research_topic.index', ['research_topics'=> ResearchTopic::withCount('subtopics')->get()])->with('success', 'Eliminado correctamente');

        }
    }
}
