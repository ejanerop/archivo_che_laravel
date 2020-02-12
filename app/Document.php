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

    public function requests(){
        return $this->hasMany('App\Request');
    }

    public function scopeFilterName($query, $name)
    {
        return $query->where('name', 'like', '%'. $name .'%');
    }

    public function scopeFilterDateStart($query, $date)
    {
        //TODO
        return $query->where('name', '>', 100);
    }

    public function scopeFilterDateEnd($query, $date)
    {
        //TODO
        return $query->where('name', '>', 100);
    }

    public function scopeFilterTopic($query, $topic)
    {
        //TODO
        return $query->where('name', '>', 100);
    }

    public function scopeFilterSubtopic($query, $topic)
    {
        //TODO
        return $query->where('name', '>', 100);
    }

    public function scopeFilterType($query, $type)
    {
        //TODO
        return $query->where('name', '>', 100);
    }
}
