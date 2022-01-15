<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\CheckStatus;
use App\Http\Controllers\HomeController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/Dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::group(['middleware' => CheckStatus::class], function()
{

    Route::resource('userDetails', '\App\Http\Controllers\UserController');

    Route::resource('jobs', '\App\Http\Controllers\JobController');
    Route::resource('properties', '\App\Http\Controllers\PropertyController');
    Route::get('getUserToken','\App\Http\Controllers\UserController@getUserToken');

});



Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::any('{any}', [HomeController::class,'index']);

