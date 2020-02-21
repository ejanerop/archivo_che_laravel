<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccessLevel extends Model
{

    protected $table = 'access_levels';

    public function documents(){
        return $this->hasMany('App\Documents', 'access_level_id');
    }

    public function roles(){
        return $this->hasMany('App\Roles', 'access_level_id');
    }
}
