<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates = ['dob', 'created_at', 'updated_at','deleted_at']; 
//     public function getSomeDateAttribute($date)
// {
//     return $date->format('d-m-y');
// }
       protected $fillable = [
        'frist_name','last_name', 'email', 'password','telephone','dob','gender','avatar','status'
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

    
    const STATUS_SELECT = [
        false => 'Blocked',
        true => 'Active',
    ];
    const GENDER_SELECT = [
        'male' => 'male',
        'female' => 'female',
    ];
}
