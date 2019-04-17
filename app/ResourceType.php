<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResourceType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'resource_type';

    public function document_types(){
        return $this->hasMany('App\DocumentType', 'resource_type_id');
    }
}
