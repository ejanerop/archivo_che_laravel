<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccessLevel extends Model
{

    protected $table = 'access_levels';

    public function documents(){
        return $this->hasMany('Documents', 'access_level_id');
    }
}
