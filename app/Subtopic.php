<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subtopic extends Model
{

    protected $table = 'subtopics';

    public function research_topic(){
        return $this->belongsTo('App\ResearchTopic', 'research_topic_id');
    }

    public function documents(){
        return $this->belongsToMany('App\Document', 'document_subtopic');
    }
}
