<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiToken;

class User extends Authenticatable
{
    use Notifiable,HasApiToken;

    
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function subscription(){
        return $this->hasOne('App\Subscription');
    }
    public function transactions(){
        return $this->hasMany('App\Transaction');
    }
    public function plan(){
        return $this->hasOne('App\Plan');
    }
}
