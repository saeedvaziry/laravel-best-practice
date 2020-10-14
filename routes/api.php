<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('posts', 'API\PostController@index')->name('api.posts');
    Route::post('posts', 'API\PostController@store');
    Route::get('posts/{id}', 'API\PostController@show')->name('api.posts.show');
    Route::put('posts/{id}', 'API\PostController@update');
    Route::delete('posts/{id}', 'API\PostController@destroy');
});
