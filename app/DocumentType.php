<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{

    public function documents(){
        return $this->hasMany('App\Document','document_type_id');
    }

    public function resource_type(){
        return $this->belongsTo('App\ResourceType', 'resource_type_id');
    }

    public function subpetitions()
    {
        return $this->morphMany('App\Subpetition', 'object');
    }
}
