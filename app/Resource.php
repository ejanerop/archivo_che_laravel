<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Resource extends Model
{

    public function document()
    {
        return $this->belongsTo('App\Document', 'document_id');
    }

    public function getPathAttribute()
    {
        $path = substr($this->src, strpos($this->src, '\\') + 1);
        return $path;
    }

    public function getFileNameAttribute()
    {
        $src = $this->src;
        //TODO
        return $this->src;
    }
}
