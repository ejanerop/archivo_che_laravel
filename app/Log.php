<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    public function log_type(){
        return $this->belongsTo('App\LogType', 'log_type_id');
    }

    public function scopeFilterUser($query, $user){
        return $query->where('user', 'like', '%'. $user .'%');
    }

    public function scopeFilterLogTypes($query, $logTypes)
    {
        return $query->whereHas('log_types', function ($q) use ($logTypes) {
                $q->whereIn('slug', $logTypes);
            });
    }

    public function scopeFilterDate($query, $date){
        //TODO
    }

    public function scopeFilterIpAddress($query, $ip){
        //TODO
    }
}
