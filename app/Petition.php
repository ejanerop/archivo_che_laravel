<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Petition extends Model
{
    public function document(){
		return $this->belongsTo('App\Document', 'document_id');
    }

    public function user(){
		return $this->belongsTo('App\User', 'user_id');
    }

    public function petition_state(){
		return $this->belongsTo('App\PetitionState', 'petition_state_id');
    }
}
