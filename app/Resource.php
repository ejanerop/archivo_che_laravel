<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{

    protected $table = 'resources';

    public function document(){
        return $this->belongsTo('App\Document', 'resource_id');
    }
}
