<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
    	'plan_type','plan_name','plan_cost',
    ];
    public function users(){
    	return $this->hasMany('App\User');
    }
    public function subscription(){
    	return $this->hasMany('App\Subscription');
    }
}
