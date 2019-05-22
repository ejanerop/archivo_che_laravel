<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
    public function resource(){
        return $this->hasOne('App\Resource', 'text_id');
    }
}
