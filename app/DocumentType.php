<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    protected $table = 'document_type';

    public function documents(){
        return $this->hasMany('Documents','document_type_id');
    }
}
