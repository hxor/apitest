<?php

use Illuminate\Http\Request;

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

Route::group(['prefix' => 'user'], function () {
	Route::get('/list', 'UserController@index');
	Route::post('/store', 'UserController@store');
	Route::post('/update/{id}', 'UserController@update');
	Route::post('/delete/{id}', 'UserController@destroy');
});
