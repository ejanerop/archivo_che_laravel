<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subpetition extends Model
{

    public function petition()
    {
        return $this->belongsTo('App\Petition', 'petition_id');
    }

    public function object()
    {
        return $this->morphTo();
    }

    public function getRelatedDocumentsAttribute()
    {
        return $this->object->documents;
    }


}
