<?php

use Illuminate\Http\Request;

//rotas de cliente
Route::get('clientes/' , 'Api\ClienteApiController@index');
Route::get('clientes/{id}' , 'Api\ClienteApiController@show');

Route::post('clientes/' , 'Api\ClienteApiController@store');
Route::put('clientes/{id}' , 'Api\ClienteApiController@update');

Route::delete('clientes/{id}' , 'Api\ClienteApiController@destroy');


//rotas documento -> relacionamento 1 pra 1
Route::get('clientes/{id}/documento' , 'Api\ClienteApiController@documento');

Route::get('documento/', 'Api\DocumentoApiController@index');
Route::post('documento/', 'Api\DocumentoApiController@store');
Route::get('documento/{id}/cliente', 'Api\DocumentoApiController@cliente');

//rotas telefone -> relacionamento muitos pra 1
Route::get('clientes/{id}/telefone' , 'Api\ClienteApiController@telefone');

Route::get('telefone/', 'Api\TelefoneApiController@index');
Route::post('telefone/', 'Api\TelefoneApiController@store');
Route::get('telefone/{id}/cliente', 'Api\TelefoneApiController@cliente');

//rotas filmes -> relacionamento muitos pra muitos
Route::get('clientes/{id}/filmesalugados' , 'Api\ClienteApiController@alugados');

Route::get('filme/', 'Api\FilmeApiController@index');
Route::post('filme/', 'Api\FilmeApiController@store');
