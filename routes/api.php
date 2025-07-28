<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::any('register','App\Http\Controllers\apiController@register');

Route::any('login','App\Http\Controllers\apiController@login');

Route::any('logout','App\Http\Controllers\apiController@logout');




Route::any('data','App\Http\Controllers\apiController@data');


Route::any('flight_data','App\Http\Controllers\apiController@flight_data');


