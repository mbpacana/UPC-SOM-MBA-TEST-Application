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

Route::get('/home','AdminController@index');
Route::get('/login','AdminController@login');
Route::get('/authentication','AdminController@login');
Route::get('/instructions','AdminController@instructions');
Route::get('/exam','AdminController@exam');
Route::get('/admin','AdminController@home');
Route::get('/admin/answers','AdminController@answers');
Route::get('/admin/stashes','AdminController@stashes');
Route::get('/admin/questions','AdminController@questions');

Route::resource('questions','AdminController');