<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
	protected $fillable = [
		'plan_id','expiry_date','user_id'
	];
    public function transactions(){
    	return $this->hasMany('App\Transaction');
    }
    public function user(){
    	return $this->belongsTo('App\User');
    }
    public function plan(){
    	return $this->belongsTo('App\Plan');
    }
}
