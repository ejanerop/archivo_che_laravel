<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Log extends Model
{
    public function log_type(){
        return $this->belongsTo('App\LogType', 'log_type_id');
    }

    public function object(){
        return $this->morphTo();
    }

    public function scopeFilterUser($query, $user){
        return $query->where('user', 'like', '%'. $user .'%');
    }

    public function scopeFilterLogTypes($query, $logTypes)
    {
        return $query->whereHas('log_type', function ($q) use ($logTypes) {
                $q->whereIn('type', $logTypes);
            });
    }

    public function scopeFilterToday($query){
        return $query->whereDate('created_at',  date('Y-m-d', strtotime('today')));
    }

    public function scopeFilterDay($query, $date){
        return $query->whereDate('created_at',  $date);
    }

    public function scopeFilterIpAddress($query, $ip){
        return $query->where('ip_address', $ip);
    }

    public function getTableNameAttribute(){
        $tableName = '';

        switch ($this->object_type) {
            case 'document':
                $tableName ='Documentos';
                break;

            case 'research_topic':
                $tableName ='Temas de investigación';
                break;

            case 'subtopic':
                $tableName ='Subtemas de investigación';
                break;

            case 'document_type':
                $tableName ='Tipos de documentos';
                break;

            case 'user':
                $tableName ='Usuarios';
                break;

            default:
                $tableName ='';
                break;
        }
        return $tableName;
    }

    public function getIpAddAttribute(){
        return $this->ip_address == '::1' ? '127.0.0.1': $this->ip_address;
    }

}
