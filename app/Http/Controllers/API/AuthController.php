<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;

class AuthController extends Controller
{
    public function register(Request $request){
    	$validatedData = $request->validate([
    		'name'=>'required|max:55',
    		'email'=>'required|email',
    		'password' => 'required|confirmed'
    	]);
    	$validatedData['password'] = bcrypt($request->password);
    	$user = User::create($validatedData);
    	$accessToken = $user->createToken('authToken')->accessToken;
    	return response([
    		'user'=>$user,
    		'access_token' => $accessToken 
    	],200);
    }
    public function login(Request $request){
    	$loginData = $request->validate([
    		'email'=>'required|email',
    		'password' => 'required'
    	]);
    	if(!auth()->attempt($loginData)){
    		return response([
    			"message"=>"Invalid Credentials"
    		]);
    	}
    	$accessToken = auth()->user()->createToken('authToken')->accessToken;
    	return response([
    		'user'=>auth()->user(),
    		'access_token'=>$accessToken,
            'message' => 'Login successful'
    	]);
    }
}
