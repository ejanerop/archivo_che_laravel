<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{

    public function resources(){
        return $this->hasMany('App\Resource');
    }

    public function subtopics(){
        return $this->belongsToMany('App\Subtopic', 'document_subtopic');
    }

    public function author(){
        return $this->belongsTo('App\Author', 'author_id');
    }

    public function document_type(){
        return $this->belongsTo('App\DocumentType', 'document_type_id');
    }

    public function access_level(){
        return $this->belongsTo('App\AccessLevel', 'access_level_id');
    }

    public function stage(){
        return $this->belongsTo('App\Stage', 'stage_id');
    }

    public function logs(){
        return $this->morphMany('App\Log', 'object');
    }

    public function custom_date(){
        return $this->belongsTo('App\CustomDate', 'custom_date_id');
    }

    public function getDateFormatedAttribute(){

        return $this->custom_date->dateFormatted;

    }

    public function getDateStartAttribute(){

        return $this->custom_date->dateStart;

    }

    public function getDateEndAttribute(){

        return $this->custom_date->dateEnd;

    }

    public function getVisitsAttribute(){
        return $this->logs()->where('log_type_id', '2')->count();
    }

    public function scopeFilterName($query, $name)
    {
        return $query->where('name', 'like', '%'. $name .'%');
    }

    public function scopeFilterAuthors($query, $authors)
    {
        $query = $query->whereHas('author', function ($q) use ($authors) {
            $q->whereIn('name', $authors);
        });
    return $query;
    }

    public function scopeFilterStages($query, $stages)
    {
        return $query->whereHas('stage', function ($q) use ($stages) {
                $q->whereIn('name', $stages);
            });
    }

    public function scopeFilterDateStart($query, $date)
    {
        return $query->where('date', '>=', $date);
    }

    public function scopeFilterDateEnd($query, $date)
    {
        return $query->where('date', '<=', $date);
    }

    public function scopeFilterSubtopics($query, $topics)
    {
        $query = $query->whereHas('subtopics', function ($q) use ($topics) {
                $q->whereIn('name', $topics);
            });
        return $query;
    }

    public function scopeFilterTypes($query, $types)
    {
        $query = $query->whereHas('document_type', function ($q) use ($types) {
            $q->whereIn('document_type', $types);
        });
    return $query;
    }

    public function scopeFilterAccessLevel($query, $accessLevel)
    {
        $query = $query->whereHas('access_level', function ($q) use ($accessLevel) {
            $q->where('level', '<=',  $accessLevel);
        });
    return $query;
    }


}
