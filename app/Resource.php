<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    public function document(){
        return $this->belongsTo('Document', 'resource_id');
    }
}
