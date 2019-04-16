<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subtopic extends Model
{
    public function research_topic(){
        return $this->belongsTo('ResearchTopic', 'research_topic_id');
    }

    public function documents(){
        return $this->belongsToMany('Document', 'document_subtopic');
    }
}
