<?php

use Illuminate\Http\Request;

//rotas de login
$this->post('login', 'Auth\AuthenticateController@authenticate');
$this->post('login-refresh', 'Auth\AuthenticateController@refreshToken');
$this->get('me', 'Auth\AuthenticateController@getAuthenticatedUser');


$this->group(['namespace' => 'Api', 'middleware' => 'auth:api'], function() {
//rotas de cliente
Route::get('clientes/' , 'ClienteApiController@index');
Route::get('clientes/{id}' , 'ClienteApiController@show');

Route::post('clientes/' , 'ClienteApiController@store');
Route::put('clientes/{id}' , 'ClienteApiController@update');

Route::delete('clientes/{id}' , 'ClienteApiController@destroy');


//rotas documento -> relacionamento 1 pra 1
Route::get('clientes/{id}/documento' , 'ClienteApiController@documento');

Route::get('documento/', 'DocumentoApiController@index');
Route::post('documento/', 'DocumentoApiController@store');
Route::get('documento/{id}/cliente', 'DocumentoApiController@cliente');

//rotas telefone -> relacionamento muitos pra 1
Route::get('clientes/{id}/telefone' , 'ClienteApiController@telefone');

Route::get('telefone/', 'TelefoneApiController@index');
Route::post('telefone/', 'TelefoneApiController@store');
Route::get('telefone/{id}/cliente', 'TelefoneApiController@cliente');

//rotas filmes -> relacionamento muitos pra muitos
Route::get('clientes/{id}/filmesalugados' , 'ClienteApiController@alugados');

Route::get('filme/', 'FilmeApiController@index');
Route::post('filme/', 'FilmeApiController@store');

});