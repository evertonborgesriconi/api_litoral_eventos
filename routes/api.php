<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('/register', 'App\Http\Controllers\CriadorController@register');
Route::post('/login', 'App\Http\Controllers\CriadorController@login');

Route::get('/categorias', 'App\Http\Controllers\CategoriaController@index');
Route::get('/assuntos', 'App\Http\Controllers\AssuntoController@index');
Route::post('/logout', 'App\Http\Controllers\CriadorController@logout');
Route::get('/eventos', 'App\Http\Controllers\EventosController@getAllEventos');
Route::get('/eventos/{uf}/{cidade}', 'App\Http\Controllers\EventosController@getAEventosByLocalization');
Route::get('/evento/{id}', 'App\Http\Controllers\EventosController@getById');
Route::get('/buscacatassunto/{id_assunto)/{id_categoria}', 'App\Http\Controllers\EventosController@getCatAsu');

Route::get('/getlocal/{id}', 'App\Http\Controllers\LocalIngressoController@getLocalByEvento');

Route::post('/viewevento', 'App\Http\Controllers\EventosController@addview');

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::post('/validatoken', 'App\Http\Controllers\CriadorController@tokenValidation');

    Route::post('/logout', 'App\Http\Controllers\CriadorController@logout');
    Route::get('/criador/{id}', 'App\Http\Controllers\CriadorController@indexId');

    Route::post('/registerevento', 'App\Http\Controllers\EventosController@register');
    Route::put('/editarevento/{id}', 'App\Http\Controllers\EventosController@update');
    Route::delete('/deleteevento/{id}', 'App\Http\Controllers\EventosController@deletar');

    Route::get('/eventosidcriador/{id}', 'App\Http\Controllers\EventosController@getEventosByIdCriador');
    Route::get('/eventosbyid/{id}/{criador_id}', 'App\Http\Controllers\EventosController@indexId');

    Route::post('/registerlocalingresso', 'App\Http\Controllers\LocalIngressoController@register');
    Route::delete('/deletelocal/{id}', 'App\Http\Controllers\LocalIngressoController@deletar');


});
