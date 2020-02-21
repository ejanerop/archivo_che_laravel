<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public function roles(){
        return $this->belongsTo('App\Role', 'role_id');
    }

    public function petitions(){
        return $this->hasMany('App\Petition');
    }

    public function getLevelAttribute(){
        return $this->roles->access_level->level;
    }

    public function getPetitionCountAttribute(){
        return User::withCount('petitions')->where('id', $this->id)->first()->petitions_count;
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
