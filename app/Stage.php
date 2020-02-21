<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    public function isInPetition(Petition $petition){
        $result = false;
        $subpetitions = $petition->subpetitions;
        foreach ($subpetitions as $subpetition) {
            if ($subpetition->isType('stage')) {
                if ($subpetition->object_id == $this->id) {
                    $result = true;
                }
            }
        }
        return $result;
    }
}
