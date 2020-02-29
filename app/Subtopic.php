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

    public function subpetitions()
    {
        return $this->morphMany('App\Subpetition', 'object');
    }

    public function logs(){
        return $this->morphMany('App\Log', 'object');
    }

    public function scopeFilterName($query, $name)
    {
        return $query->where('name', $name);
    }

    public function getVisitsAttribute(){
        $sum = 0;
        foreach ($this->documents as $document) {
            $sum += $document->visits;
        }
        return $sum;
    }
}
