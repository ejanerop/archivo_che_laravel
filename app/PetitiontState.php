<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PetitionState extends Model
{
    public function petitions()
    {
        return $this->hasMany('App\Petition');
    }
}
