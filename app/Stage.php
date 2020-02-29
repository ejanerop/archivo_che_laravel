<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    public function subpetitions()
    {
        return $this->morphMany('App\Subpetition', 'object');
    }

    public function documents()
    {
        return $this->hasMany('App\Document');
    }
}
