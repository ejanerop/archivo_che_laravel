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
}
