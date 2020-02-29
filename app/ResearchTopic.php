<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResearchTopic extends Model
{

    public function subtopics(){
        return $this->hasMany('App\Subtopic', 'research_topic_id');
    }

    public function logs(){
        return $this->morphMany('App\Log', 'object');
    }

}
