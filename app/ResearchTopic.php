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

    public function getDocumentsCountAttribute(){
        $subtopics = $this->subtopics;
        $documents = collect();
        foreach ($subtopics as $subtopic) {
            $subtopic->load('documents');
            $documents = $documents->merge($subtopic->documents);
        }
        $documents = $documents->unique('id');
        return $documents->count();
    }
}
