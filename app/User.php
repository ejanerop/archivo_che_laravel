<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    public function roles(){
        return $this->belongsTo('App\Role', 'role_id');
    }

    public function petitions(){
        return $this->hasMany('App\Petition');
    }

    public function logs(){
        return $this->morphMany('App\Log', 'object');
    }

    public function getLevelAttribute(){
        return $this->roles->access_level->level;
    }

    public function getPetitionCountAttribute(){
        return User::withCount('petitions')->where('id', $this->id)->first()->petitions_count;
    }

    public function getApprovedDocumentsAttribute(){
        $petitions = $this->approved_petitions;
        $documents = collect();
        foreach ($petitions as $petition) {
            if ($documents->isEmpty()) {
                $documents = $petition->related_documents;
            }else {
                $documents = $documents->merge($petition->related_documents);
            }
        }

        return $documents;

    }

    public function getApprovedPetitionsAttribute(){
        $petitions = User::find($this->id)->petitions()->where('petition_state_id', 1)->get();

        return $petitions;

    }

    public function getApprovedSubpetitionsAttribute(){
        $petitions = User::find($this->id)->approved_petitions;
        $subpetitions = collect();
        foreach ($petitions as $petition) {
            $subpetitions = $subpetitions->concat($petition->subpetitions);
        }

        return $subpetitions;

    }

    public function canSeeAll(){

        return $this->roles->access_level->name == 'Secreto'? true : false ;

    }

    public function isDocumentPermitted($id){
        $permitted = false;

        $documents = Document::filterAccessLevel(Auth::user()->level)->get();
        $documentsApproved = $this->approved_documents;
        foreach ($documents as $document) {
            if ($document->id == $id) {
                $permitted = true;
            }
        }
        foreach ($documentsApproved as $document) {
            if ($document->id == $id) {
                $permitted = true;
            }
        }
        return $permitted;
    }

    public function hasRole($role){
        if($this->roles()->where('slug',$role)->first()) {
            return true;
        }else{
            return false;
        }
    }

    public function authorizeRole($role){
        if($this->hasRole($role)){
            return true;
        }else{
            abort(401, 'No tienes permiso para hacer eso.');
        }
    }

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'role_id' => 1,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
