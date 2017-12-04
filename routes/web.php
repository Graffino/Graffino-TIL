<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('profile', 'DeveloperController@show');
Route::get('profile/edit', 'DeveloperController@edit');
Route::put('profile/edit', 'DeveloperController@update');

Route::get('admin', 'AuthController@index');
Route::get('auth/github', 'AuthController@request');
Route::get('auth/github/callback', 'AuthController@callback');
Route::get('auth/logout', 'AuthController@delete');
