<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded=['id'];

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

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function hasKey(){
        return $this->licence_key!=null;
    }

    public function isSuperUser(){
        foreach($this->roles as $role){
            if($role->slug=='super-admin'){
                return true;
            }
        }
        return false;
    }

    public function hasPermission ($permission){
        foreach($this->roles as $role){
            if($role->hasPermission($permission)){
                return true;
            }
        }
        return false;
    }

    public function setLicenceKeyAttribute($value){
        $this->attributes['licence_key'] = Hash::make($value);
    }
}
