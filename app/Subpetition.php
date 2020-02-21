<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subpetition extends Model
{
    public function petition_type(){
		return $this->belongsTo('App\PetitionType', 'petition_type_id');
    }

    public function petition(){
        return $this->belongsTo('App\Petition', 'petition_id');
    }

    public function isType($type){
        if($this->petition_type->slug == $type){
            return true;
        }else {
            return false;
        }
    }


}
