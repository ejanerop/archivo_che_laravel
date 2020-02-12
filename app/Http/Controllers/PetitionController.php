<?php

namespace App\Http\Controllers;

use App\Petition;
use App\PetitionState;
use Illuminate\Http\Request;

class PetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('petition.index',['petitions'=> Petition::with(['document', 'petition_state', 'user'])->get()]);
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
        
        return redirect()->route('petition.index')->with('success','La solicitud fue denegada correctamente.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
    }
}
