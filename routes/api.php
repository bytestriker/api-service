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

Route::middleware("guest")->post('/register', 'AuthAPIController@register');
Route::middleware("guest")->post('/login', 'AuthAPIController@login');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'], function(){
  Route::resource('/banners', BannerAPIController::class);
  Route::resource('/photos', PhotoAPIController::class);
  Route::get('/logout', 'AuthAPIController@logout');
  
});




