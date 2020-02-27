<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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

    public function getTableNameAttribute(){
        $tableName = '';

        switch ($this->object_table) {
            case 'documents':
                $tableName ='Documentos';
                break;

            case 'research_topics':
                $tableName ='Temas de investigación';
                break;

            case 'subtopics':
                $tableName ='Subtemas de investigación';
                break;

            case 'document_types':
                $tableName ='Tipos de documentos';
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
