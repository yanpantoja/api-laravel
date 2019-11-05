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

Route::get('clientes/' , 'Api\ClienteApiController@index');
Route::get('clientes/{id}' , 'Api\ClienteApiController@show');

Route::post('clientes/' , 'Api\ClienteApiController@store');
Route::put('clientes/{id}' , 'Api\ClienteApiController@update');

Route::delete('clientes/{id}' , 'Api\ClienteApiController@destroy');
