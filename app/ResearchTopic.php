<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResearchTopic extends Model
{
    protected $table = 'research_topic';

    public function subtopics(){
        return $this->hasMany('ResearchTopic', 'research_topic_id');
    }
}
