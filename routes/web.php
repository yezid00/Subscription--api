<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::post('register','API\AuthController@register');
Route::post('/login','Api\AuthController@login');

Route::apiResource('/plans','Api\PlanController')->middleware('auth');
Route::apiResource('/subscriptions','Api\SubscriptionController')->middleware('auth');
Route::apiResource('/transactions','Api\TransactionController')->middleware('auth');