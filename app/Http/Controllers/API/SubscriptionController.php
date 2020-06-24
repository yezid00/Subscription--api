<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Subscription;
use Illuminate\Http\Request;
use App\Http\Resources\SubscriptionResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\Guard;

class SubscriptionController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscriptions = Subscription::all();
        return response([
            'subscriptions' =>new SubscriptionResource($subscriptions),
            'message' => 'All subscription'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validator = $this->validate($request,[
            'expiry_date' => 'required|date',
            'plan_id' => 'required',
        ]);

        
        $subscription = new Subscription;
        $subscription->user_id = auth()->user()->id;
        $subscription->plan_id = $request->plan_id;
        $subscription->expiry_date = $request->expiry_date; //Y-m-d

        $subscription->save();
        return response([
            'subscription' => new SubscriptionResource($subscription),
            'message' => 'Subscription successful'
        ],200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function show(Subscription $subscription)
    {
        return response([
            'subscription'=> new SubscriptionResource($subscription),
            'message' => 'Subscription retrieved'
        ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscription $subscription)
    {
        $subscription->update($request->all());
        return response([
            'subscription' => new SubscriptionResource($subscription),
            'message' => 'Subscription details updated'
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscription $subscription)
    {
        $subscription->delete();
        return response([
            'message' => 'Subscription deleted'
        ]);
    }
}
