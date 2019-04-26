<?php

namespace App\Http\Controllers;

use App\ResearchTopic;
use App\Subtopic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SubtopicController extends Controller
{
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

        return redirect()->route('subtopic.index', ['subtopics' => Subtopic::with('research_topic')->get()]);
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

        return redirect()->route('subtopic.index', ['subtopics' => Subtopic::with('research_topic')->get()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //todo
    }
}
