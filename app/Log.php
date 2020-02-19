<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Log extends Model
{
    public function log_type(){
        return $this->belongsTo('App\LogType', 'log_type_id');
    }

    public function getObjectNameAttribute(){

        $objectName = 'probando';
        $id = intval($this->object);

        switch ($this->object_table) {

            case 'documents':
                try {
                    $objectName = Document::findOrFail($id)->name;
                } catch (ModelNotFoundException $th) {
                    $objectName = 'No encontrado';
                }
                break;

            case 'document_types':
                try {
                    $objectName = DocumentType::findOrFail($id)->document_type;
                } catch (ModelNotFoundException $th) {
                    $objectName = 'No encontrado';
                }
                break;

            case 'research_topics':
                try {
                    $objectName = ResearchTopic::findOrFail($id)->research_topic;
                } catch (ModelNotFoundException $th) {
                    $objectName = 'No encontrado';
                }
                break;

            case 'subtopics':
                try {
                    $objectName = Subtopic::findOrFail($id)->name;
                } catch (ModelNotFoundException $th) {
                    $objectName = 'No encontrado';
                }
                break;

            case 'users':
                try {
                    $objectName = User::findOrFail($id)->username;
                } catch (ModelNotFoundException $th) {
                    $objectName = 'No encontrado';
                }
                break;

            default:
                break;
        }
        return $objectName;
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
