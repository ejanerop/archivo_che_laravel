<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Petition extends Model
{
    public function user(){
		return $this->belongsTo('App\User', 'user_id');
    }

    public function petition_state(){
		return $this->belongsTo('App\PetitionState', 'petition_state_id');
    }

    public function subpetitions(){
		return $this->hasMany('App\PetitionType', 'petition_id');
    }
}
