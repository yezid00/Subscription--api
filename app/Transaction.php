<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
	protected $fillable = [
		'plan_type','subscription_id',
	];
    public function user(){
    	return $this->belongsTo('App\User');
    }
    public function subscription(){
    	return $this->belongsTo('App\Subscription');
    }
    
    
}
