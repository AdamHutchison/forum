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

//Thread Routes
Route::get('/threads', 'ThreadController@index');
Route::get('/threads/create', 'ThreadController@create');
Route::get('/threads/{channel}/{thread}', 'ThreadController@show');
Route::post('/threads','ThreadController@store');
//Reply Routes
Route::post('/threads/{thread}/replies', 'ReplyController@store');

//Auth Routes
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
