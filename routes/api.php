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

Route::group(['namespace' => 'Api', 'as' => 'api::'], function () {
    Route::group(['as' => 'user::', 'prefix' => 'user'], function () {
        Route::post('/register', ['uses' => 'UserController@register'])->name('register');
        Route::post('/logout', ['uses' => 'UserController@logout'])->name('logout')->middleware('auth:api');


        Route::get('/profile', [ 'uses' => 'UserController@profile'])->name('profile')->middleware('auth:api');
    });
    Route::group(['as' => 'note::', 'prefix' => 'note'], function () {
        Route::post('/create', [ 'uses' => 'NoteController@create'])->name('create')->middleware('auth:api');
        Route::post('/update/{id}', [ 'uses' => 'NoteController@update'])->name('update')->middleware('auth:api');

        Route::get('/index', [ 'uses' => 'NoteController@index'])->name('index')->middleware('auth:api');
        Route::get('/show/{id}', [ 'uses' => 'NoteController@show'])->name('show')->middleware('auth:api');

    });
});