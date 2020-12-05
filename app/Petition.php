<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Petition extends Model
{
    public function user(){
		return $this->belongsTo('App\User', 'user_id')->withTrashed();
    }

    public function petition_state(){
		return $this->belongsTo('App\PetitionState', 'petition_state_id');
    }

    public function access_level(){
		return $this->belongsTo('App\AccessLevel', 'access_level_id');
    }

    public function subpetitions(){
		return $this->hasMany('App\Subpetition', 'petition_id');
    }

    public function getCreatedDateAttribute(){
        $year = substr($this->created_at, 0, 4);
        $month = substr($this->created_at, 5, 2);
        $monthText = '';
        $day = substr($this->created_at, 8, 2);
        switch ($month) {
            case '01':
                $monthText = 'enero';
                break;

            case '02':
                $monthText = 'febrero';
                break;

            case '03':
                $monthText = 'marzo';
                break;

            case '04':
                $monthText = 'abril';
                break;

            case '05':
                $monthText = 'mayo';
                break;

            case '06':
                $monthText = 'junio';
                break;

            case '07':
                $monthText = 'julio';
                break;

            case '08':
                $monthText = 'agosto';
                break;

            case '09':
                $monthText = 'septiembre';
                break;

            case '10':
                $monthText = 'octubre';
                break;

            case '11':
                $monthText = 'noviembre';
                break;

            case '12':
                $monthText = 'diciembre';
                break;

            default:
                $monthText = 'enero';
                break;
        }
        return $day . ' de ' . $monthText . ' de ' . $year;
    }

    public function getRelatedDocumentsAttribute(){
        $documents = collect();
        $docsByDocType = collect();
        $docsByStage = collect();
        $docsBySubtopic = collect();
        foreach ($this->subpetitions as $subpetition) {
            if ($subpetition->object_type == 'document_type') {
                if($docsByDocType->isEmpty()){
                    $docsByDocType = $subpetition->related_documents;
                }else {
                    $docsByDocType = $docsByDocType->merge($subpetition->related_documents);
                }
            }elseif ($subpetition->object_type == 'stage') {
                if($docsByStage->isEmpty()){
                    $docsByStage = $subpetition->related_documents;
                }else {
                    $docsByStage = $docsByStage->merge($subpetition->related_documents);
                }
            }elseif ($subpetition->object_type == 'subtopic') {
                if($docsBySubtopic->isEmpty()){
                    $docsBySubtopic = $subpetition->related_documents;
                }else {
                    $docsBySubtopic = $docsBySubtopic->merge($subpetition->related_documents);
                }
            }
        }
        if (!($docsByDocType->isEmpty())) {
            $documents = $docsByDocType;
            if ((!($docsByStage->isEmpty()))) {
                $documents = $documents->intersect($docsByStage);
            }
            if ((!($docsBySubtopic->isEmpty()))) {
                $documents = $documents->intersect($docsBySubtopic);
            }
        }elseif ((!($docsByStage->isEmpty()))) {
            $documents = $docsByStage;
            if ((!($docsBySubtopic->isEmpty()))) {
                $documents = $documents->intersect($docsBySubtopic);
            }
        }else {
            $documents = $docsBySubtopic;
        }

        return $documents;
    }


}
