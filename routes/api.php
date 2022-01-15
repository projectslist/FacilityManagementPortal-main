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

//Protected routes
Route::group(['middleware' => ['auth:sanctum']],function(){

    Route::post('jobsforapi', '\App\Http\Controllers\JobController@store');
    Route::delete('jobsforapi/{id}', '\App\Http\Controllers\JobController@destroy');
    Route::put('jobsforapi/{id}', '\App\Http\Controllers\JobController@update');
    Route::post('logout', '\App\Http\Controllers\ApiUserAuthController@logout');

});

//Public routes
Route::post('register', '\App\Http\Controllers\ApiUserAuthController@register');
Route::post('login', '\App\Http\Controllers\ApiUserAuthController@login');

Route::get('jobsforapi', '\App\Http\Controllers\JobController@index');
Route::get('jobsforapi/{id}', '\App\Http\Controllers\JobController@show');





Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


