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

Route::get('authors/{username}', 'DeveloperController@show');

Route::get('/', 'PostController@index');
Route::get('/posts/new', 'PostController@new');
Route::post('/posts/create', 'PostController@create');
Route::get('/posts/{id}', 'PostController@show');
Route::get('/posts/{id}/edit', 'PostController@edit');
Route::put('/posts/{id}/update', 'PostController@update');
Route::get('/random', 'PostController@random');

Route::get('/search', 'PostController@search');
