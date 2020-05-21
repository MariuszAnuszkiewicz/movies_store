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

    Route::get('/movies', 'Api\MoviesApiController@list');
    Route::post('/movies', 'Api\MoviesApiController@create');
    Route::put('/movies/{id}', 'Api\MoviesApiController@update')->where('id', '[0-9]+');
    Route::delete('/movies/{id}', 'Api\MoviesApiController@destroy')->where('id', '[0-9]+');
    Route::post('/movies/search', 'Api\MoviesApiController@search');

