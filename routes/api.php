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

Route::group(['namespace' => 'Api\V1', 'prefix' => 'v1', 'as' => 'api.v1.'], function () {
    Route::get('songs', 'SongsController@index')->name('songs.index');
    Route::get('songs/{id}', 'SongsController@show')->name('songs.show')->where('id', '[0-9]+');
    Route::patch('songs/{id}', 'SongsController@update')->name('songs.update')->where('id', '[0-9]+');
});
