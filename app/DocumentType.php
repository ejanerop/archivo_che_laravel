<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{

    public function documents(){
        return $this->hasMany('App\Document','document_type_id');
    }

    public function resource_type(){
        return $this->belongsTo('App\ResourceType', 'resource_type_id');
    }

    public function isInPetition(Petition $petition){
        $result = false;
        $subpetitions = $petition->subpetitions;
        foreach ($subpetitions as $subpetition) {
            if ($subpetition->isType('document_type')) {
                if ($subpetition->object_id == $this->id) {
                    $result = true;
                }
            }
        }
        return $result;
    }
}
