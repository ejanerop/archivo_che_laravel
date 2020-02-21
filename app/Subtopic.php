<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subtopic extends Model
{

    public function research_topic(){
        return $this->belongsTo('App\ResearchTopic', 'research_topic_id');
    }

    public function documents(){
        return $this->belongsToMany('App\Document', 'document_subtopic');
    }

    public function isInPetition(Petition $petition){
        $result = false;
        $subpetitions = $petition->subpetitions;
        foreach ($subpetitions as $subpetition) {
            if ($subpetition->isType('subtopic')) {
                if ($subpetition->object_id == $this->id) {
                    $result = true;
                }
            }
        }
        return $result;
    }

    public function scopeFilterName($query, $name)
    {
        return $query->where('name', $name);
    }
}
