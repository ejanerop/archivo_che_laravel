<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Resource extends Model
{

    protected $table = 'resources';

    public function document(){
        return $this->belongsTo('App\Document', 'document_id');
    }

    public function text(){
        return $this->belongsTo('App\Text', 'text_id');
    }

    public function getPathAttribute(){
        return Storage::url($this->src);
    }

    public function getFileNameAttribute(){
        $src = $this->src;
        //TODO
        return $this->src;
    }
}
