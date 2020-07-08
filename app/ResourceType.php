<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResourceType extends Model
{
    public function document_types()
    {
        return $this->hasMany('App\DocumentType', 'resource_type_id');
    }
}
