<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    protected $table = 'document_type';

    public function documents(){
        return $this->hasMany('App\Documents','document_type_id');
    }

    public function resource_type(){
        return $this->belongsTo('App\ResourceType', 'resource_type_id');
    }
}
