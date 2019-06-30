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

//Api Version 1 routes
Route::group(['namespace' => 'Api\V1', 'prefix' => 'v1', 'as' => 'api.v1.'], function () {
    Route::get('songs', 'SongsController@index')->name('songs.index');
    Route::get('songs/{id}', 'SongsController@show')->name('songs.show')->where('id', '[0-9]+');
});
//Api Version 2 routes
Route::group(['namespace' => 'Api\V2', 'prefix' => 'v2', 'as' => 'api.v2.'], function () {
    Route::get('songs', 'SongsController@index')->name('songs.index');
    Route::get('songs/{id}', 'SongsController@show')->name('songs.show')->where('id', '[0-9]+');
});
