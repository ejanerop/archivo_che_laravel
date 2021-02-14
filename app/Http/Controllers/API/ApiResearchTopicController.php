<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ResearchTopic;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ApiResearchTopicController extends Controller
{

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return ResearchTopic::with('subtopics')->get();
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
            'research_topic' => 'required|unique:research_topics',
            'description' => 'nullable|max:255'
            ]);
            $researchTopic = new ResearchTopic();
            $researchTopic->research_topic = $request->input('research_topic');
            $researchTopic->description = $request->input('description');
            $researchTopic->save();

            //Logger::log('create', 'research_topic', $researchTopic->id, $researchTopic->research_topic);

            return response()->json('Tema de investigación creado correctamente.', 201);
        }


        /**
        * Display the specified resource.
        *
        * @param  \App\ResearchTopic  $researchTopic
        * @return \Illuminate\Http\Response
        */
        public function show(ResearchTopic $researchTopic)
        {
            $researchTopic->load('subtopics');
            return $researchTopic;
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
                'research_topic' => ['required', Rule::unique('research_topics')->ignore($researchTopic->id)],
                'description' => ['nullable', 'max:255']
                ])->validate();

                $researchTopic->research_topic = $request->input('research_topic');
                $researchTopic->description = $request->input('description');
                $researchTopic->save();

                //Logger::log('update', 'research_topic', $researchTopic->id, $researchTopic->research_topic);

                return response()->json('Editado correctamente', 204);
            }


            /**
            * Remove the specified resource from storage.
            *
            * @param  \App\ResearchTopic $researchTopic
            * @return \Illuminate\Http\Response
            * @throws \Exception
            */
            public function destroy(ResearchTopic $researchTopic)
            {
                if($researchTopic->subtopics()->count() != 0){
                    return redirect()->route('research_topic.index', ['research_topics'=> ResearchTopic::withCount('subtopics')->get()])->with('error', 'No se puede eliminar, existen subtemas pertenecientes a este tema.');
                }else{
                    $name = $researchTopic->research_topic;
                    $researchTopic->delete();

                    //Logger::log('delete', 'research_topic', $researchTopic->id, $name);

                    return redirect()->route('research_topic.index', ['research_topics'=> ResearchTopic::withCount('subtopics')->get()])->with('success', 'Eliminado correctamente');
                }
            }
        }
