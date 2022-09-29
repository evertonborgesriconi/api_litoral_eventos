<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('/register', 'App\Http\Controllers\Auth\RegisterCriadorController@register');
Route::post('/login', 'App\Http\Controllers\Auth\LoginCriadorController@login');

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::post('/logout', 'App\Http\Controllers\Auth\LoginCriadorController@logout');
  
});

