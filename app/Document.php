<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{

    protected $table = 'documents';

    public function resources(){
        return $this->hasMany('App\Resource');
    }

    public function subtopics(){
        return $this->belongsToMany('App\Subtopic', 'document_subtopic');
    }

    public function document_type(){
        return $this->belongsTo('App\DocumentType', 'document_type_id');
    }

    public function access_level(){
        return $this->belongsTo('App\AccessLevel', 'access_level_id');
    }

    public function petitions(){
        return $this->hasMany('App\Petition');
    }

    public function stage(){
        return $this->belongsTo('App\Stage', 'stage_id');
    }

    public function scopeFilterName($query, $name)
    {
        return $query->where('name', 'like', '%'. $name .'%');
    }

    public function scopeFilterStages($query, $stages)
    {
        return $query->whereHas('stage', function ($q) use ($stages) {
                $q->whereIn('name', $stages);
            });
    }

    public function scopeFilterDateStart($query, $date)
    {
        return $query->where('date', '>=', $date);
    }

    public function scopeFilterDateEnd($query, $date)
    {
        return $query->where('date', '>=', $date);
    }

    public function scopeFilterSubtopics($query, $topics)
    {
        $query = $query->whereHas('subtopics', function ($q) use ($topics) {
                $q->whereIn('name', $topics);
            });
        return $query;
    }

    public function scopeFilterTypes($query, $types)
    {
        $query = $query->whereHas('document_type', function ($q) use ($types) {
            $q->whereIn('document_type', $types);
        });
    return $query;
    }
}
