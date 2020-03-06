<?php

namespace App\Http\Controllers;

use App\AccessLevel;
use App\DocumentType;
use App\Petition;
use App\PetitionState;
use App\PetitionType;
use App\ResourceType;
use App\ResearchTopic;
use App\Stage;
use App\Rules\DateNow;
use App\Rules\DateString;
use App\Subpetition;
use App\Subtopic;
use App\Util\Logger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PetitionController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
        $this->middleware('user.has.role:manager')->only('index', 'acceptPetition', 'denyPetition', 'show');
        $this->middleware('user.has.role:guest,inv.int,inv.ext')->only('create', 'myPetitions','store');
        $this->middleware('user.has.role:guest,inv.int,inv.ext,manager')->only('destroy');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('petition.index',['petitions'=> Petition::with(['petition_state', 'user'])->get()]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myPetitions()
    {
        $petitions = Auth::user()->petitions;

        return view('petition.myPetitions',['petitions'=> $petitions]);
    }



    /**
     * Accepts a petiton.
     *
     * @return \Illuminate\Http\Response
     */
    public function acceptPetition($petition)
    {
        $petitionState = PetitionState::where('slug', 'approved')->first();

        $petition = Petition::find($petition);
        $petition->petition_state()->dissociate();
        $petition->petition_state()->associate($petitionState);
        $petition->save();
        Logger::log('permit', '', null, '');

        return redirect()->route('petition.index')->with('success','La solicitud fue aceptada correctamente.');
    }


    /**
     * Deny a petition.
     *
     * @return \Illuminate\Http\Response
     */
    public function denyPetition($petition)
    {

        $petitionState = PetitionState::where('slug', 'denied')->first();

        $petition = Petition::find($petition);
        $petition->petition_state()->dissociate();
        $petition->petition_state()->associate($petitionState);
        $petition->save();
        Logger::log('deny', '', null, '');

        return redirect()->route('petition.index')->with('success','La solicitud fue denegada correctamente.');
    }

 /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accessLevels = AccessLevel::where('level','<>', 1)->get();
        return view('petition.create', [
            'resourceTypes' => ResourceType::with('document_types')->get(),
            'topics' => ResearchTopic::with('subtopics')->get(),
            'stages' => Stage::all(),
            'access_levels' => $accessLevels
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'subtopics' => 'required_without_all:documentTypes,stages,dateStart,dateEnd',
            'documentTypes' => 'required_without_all:subtopics,stages,dateStart,dateEnd',
            'stages' => 'required_without_all:documentTypes,subtopics,dateStart,dateEnd',
            'dateStart' => [new DateString(), new DateNow(), 'required_with:dateEnd', 'required_without_all:documentTypes,stages,subtopics'],
            'dateEnd' => [new DateString(), new DateNow(), 'required_with:dateStart', 'required_without_all:documentTypes,stages,subtopics']
        ])->validate();


        $user = Auth::user();

        if($user->petition_count > 5){
            return redirect()->route('home');
        }else{
            $petition = new Petition();
            $petition->user()->associate($user);
            $petition->petition_state()->associate(PetitionState::where('slug', 'made')->first());
            if ($request->has('notes')){
                $petition->notes = $request->input('notes');
            }
            if ($request->has('access_level')){
                $petition->access_level()->associate(AccessLevel::where('name', $request->input('access_level'))->first());
            }
            $petition->save();
            Logger::log('request', '', null, '');

            if ($request->has('subtopics')){
                foreach ($request->input('subtopics') as $subtopic) {
                    $topic = Subtopic::where('name', $subtopic)->first();
                    $subpetition = new Subpetition();
                    $subpetition->petition()->associate($petition);
                    $subpetition->object_type ='subtopic';
                    $subpetition->object_id = $topic->id;
                    $subpetition->save();
                }
            }

            if ($request->has('documentTypes')){
                foreach ($request->input('documentTypes') as $documentType) {
                    $documentType = DocumentType::where('document_type', $documentType)->first();
                    $subpetition = new Subpetition();
                    $subpetition->petition()->associate($petition);
                    $subpetition->object_type = 'document_type';
                    $subpetition->object_id = $documentType->id;
                    $subpetition->save();
                }
            }

            if ($request->has('stages')){
                foreach ($request->input('stages') as $stage) {
                    $stage = Stage::where('name', $stage)->first();
                    $subpetition = new Subpetition();
                    $subpetition->petition()->associate($petition);
                    $subpetition->object_type = 'stage';
                    $subpetition->object_id = $stage->id;
                    $subpetition->save();
                }
            }elseif($request->has('dateStart')){
                //
            }

            return redirect()->route('home');
        }

    }


    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Petition $petition)
    {
        $petition->load('subpetitions', 'user', 'petition_state', 'access_level');
        $accessLevels = AccessLevel::where('level','<>', 1)->get();
        $subpetitions = $petition->subpetitions;
        $stagesSelected = [];
        $documentTypesSelected = [];
        $subtopicsSelected = [];

        foreach ($subpetitions as $subpetition) {
            if ($subpetition->object_type == 'stage') {
                array_push($stagesSelected, $subpetition->object->id);
            } elseif ($subpetition->object_type == 'document_type') {
                array_push($documentTypesSelected, $subpetition->object->id);
            } else {
                array_push($subtopicsSelected, $subpetition->object->id);
            }
        }

        return view('petition.show', ['petition' => $petition,
                                      'subpetitions' => $subpetitions,
                                      'stages' => Stage::all(),
                                      'access_levels' => $accessLevels,
                                      'resourceTypes' => ResourceType::with('document_types')->get(),
                                      'topics' => ResearchTopic::with('subtopics')->get(),
                                      'stagesSelected' => $stagesSelected,
                                      'documentTypesSelected' => $documentTypesSelected,
                                      'subtopicsSelected' => $subtopicsSelected]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Petition $petition)
    {
        $subpetitions = $petition->subpetitions;
        foreach ($subpetitions as $subpetition) {
            $subpetition->delete();
        }
        $petition->delete();

        return redirect()->route('petition.index')->with('success','La petición fue eliminado correctamente.');
    }
}
