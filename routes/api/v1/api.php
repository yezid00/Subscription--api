<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register','Api\AuthController@register');
Route::post('/login','Api\AuthController@login');


Route::apiResource('/plans','Api\PlanController')->middleware('auth:api');
Route::apiResource('/subscriptions','Api\SubscriptionController')->middleware('auth:api');
Route::apiResource('/transactions','Api\TransactionController')->middleware('auth:api');
Route::apiResource('/users','Api\UserController')->middleware('auth:api');