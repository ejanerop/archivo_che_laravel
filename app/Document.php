<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    public function resource(){
        return $this->hasOne('Resource', 'resource_id');
    }

    public function subtopics(){
        return $this->belongsToMany('Subtopic', 'document_subtopic');
    }

    public function document_type(){
        return $this->belongsTo('DocumentType', 'document_type_id');
    }

    public function access_level(){
        return $this->belongsTo('AccessLevel', 'access_level_id');
    }
}
