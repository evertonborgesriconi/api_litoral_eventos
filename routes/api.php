<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('/register', 'App\Http\Controllers\CriadorController@register');
Route::post('/login', 'App\Http\Controllers\CriadorController@login');

Route::get('/categorias', 'App\Http\Controllers\CategoriaController@index');
Route::get('/assuntos', 'App\Http\Controllers\AssuntoController@index');


Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::post('/logout', 'App\Http\Controllers\CriadorController@logout');
    Route::get('/criador/{id}', 'App\Http\Controllers\CriadorController@indexId');
    Route::post('/registerevento', 'App\Http\Controllers\EventosController@register');
    Route::get('/eventosidcriador/{id}', 'App\Http\Controllers\EventosController@getEventos');
    Route::get('/eventosbyid/{id}/{criador_id}', 'App\Http\Controllers\EventosController@indexId');
    
  
});

