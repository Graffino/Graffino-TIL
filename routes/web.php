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

Route::group(['middleware' => ['auth']], function () {
  Route::get('profile', 'DeveloperController@show')->name('profile');
  Route::get('profile/edit', 'DeveloperController@edit')->name('profile.edit');
  Route::put('profile/edit', 'DeveloperController@update')->name('profile.update');

  Route::get('posts/new', 'PostController@new')->name('posts.new');
  Route::post('posts/create', 'PostController@create')->name('posts.create');
  Route::get('posts/{id}/edit', 'PostController@edit')->name('posts.edit');
  Route::put('posts/{id}/update', 'PostController@update')->name('posts.update');
  Route::delete('posts/{id}/delete', 'PostController@destroy')->name('posts.destroy');
});

Route::get('author/{username}', 'DeveloperController@show')->name('author');

Route::get('admin', 'DeveloperController@index')->name('login');
Route::get('auth/github', 'DeveloperController@request')->name('auth.request');
Route::get('auth/github/callback', 'DeveloperController@callback')->name('auth.callback');
Route::get('auth/logout', 'DeveloperController@delete')->name('logout');

Route::get('/', 'PostController@index')->name('posts');
Route::get('random', 'PostController@random')->name('random');
Route::get('raw/{slug}', 'PostController@raw')->name('raw');

Route::post('posts/like/{slug}', 'PostController@like')->name('like');
Route::post('posts/unlike/{slug}', 'PostController@unlike')->name('unlike');

Route::get('channel/{id}', 'ChannelController@show')->name('channel');
Route::get('search', 'PostController@search')->name('search');
Route::get('stats', 'StatsController@index')->name('stats');
Route::get('/{slug}', 'PostController@show')->name('posts.show');
