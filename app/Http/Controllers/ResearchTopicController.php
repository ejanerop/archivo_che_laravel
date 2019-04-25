<?php

namespace App\Http\Controllers;

use App\ResearchTopic;
use Illuminate\Http\Request;

class ResearchTopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('research_topic.index', ['research_topics'=> ResearchTopic::withCount('subtopics')->get()]);
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
        $research_topic = new ResearchTopic();
        $research_topic->research_topic = $request->input('research_topic');
        $research_topic->description = $request->input('description');
        $research_topic->save();

        return view('research_topic.index', ['research_topics'=> ResearchTopic::withCount('subtopics')->get()]);
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
        //todo

        return view('research_topic.index', ['research_topics'=> ResearchTopic::withCount('subtopics')->get()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ResearchTopic  $researchTopic
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResearchTopic $researchTopic)
    {
        $researchTopic->delete();

        return view('research_topic.index', ['research_topics'=> ResearchTopic::withCount('subtopics')->get()]);
    }
}
