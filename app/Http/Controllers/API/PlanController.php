<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Plan;
use Illuminate\Http\Request;
use App\Http\Resources\PlanResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\Guard;

class PlanController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = Plan::all();
        return response([
            'plans'=> PlanResource::collection($plans),
            'message'=>'Plans retrived successfully'
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
        $data = $request->all();
        $validator = Validator::make($data,[
            'plan_type' => 'required|numeric',
            'plan_name' => 'required|max:255',
            'plan_cost' => 'required|numeric'
        ]);
        if($validator->fails()){
            return response([
                'error'=>$validator->errors(),'Validation error'
            ]);
        }
        $plan = Plan::create($data);
        return response([
            'plan' => new PlanResource($plan),
            'message' =>'Created successfully'
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        return response([
            'plan' => new PlanResource($plan),
            'message' => 'Retrieved successfully'
        ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plan $plan)
    {
        $plan->update($request->all());

        return response([
            'plan' => new PlanResource($plan),
            'message' => 'Plan Updated'
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan $plan)
    {
        $plan->delete();
        return response([
            'message'=>'Plan'. $plan->plan_name. "deleted'
        ]);
    }
}
