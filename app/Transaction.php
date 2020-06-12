<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
	protected $fillable = [
		'plan_id','subscription_id','user_id'
	];
    public function user(){
    	return $this->belongsTo('App\User');
    }
    public function subscription(){
    	return $this->belongsTo('App\Subscription');
    }
    
    
}
