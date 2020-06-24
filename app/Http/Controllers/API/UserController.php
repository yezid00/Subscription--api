<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\User;
use App\Subscription;
use App\Transaction;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return response([
            'users' => UserResource::collection($users),
            'message' => "All users"
        ]);
    }

    public function show(User $user)
    {
        if($user->exists()){
            return response([
            'user' => new UserResource($user),
            'message'=>'Retrieved user'
        ],200);
        }
        else{
            return response([
                "message" => "User doesnt exist"
            ]);
        }
        
    }

    
    public function destroy($id)
    {
        $user = User::find('id',$id);
        if(User::where('id',$id)->exists()){
            $user->delete();
            return response([
                'message'=>'User Removed'
            ],202);
        }
        else{
            return response([
                "message"=>"User doesnt exist"
            ],404);
        }
        
    }
}
