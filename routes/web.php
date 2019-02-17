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
Route::get('/{id}/exam',function($id){
    return 'This is user with id of '.$id;
});
Route::get('/admin/answers','AdminController@answers');
Route::get('/admin/stashes','AdminController@stashes');
Route::get('/admin/questionnaire','AdminController@questionnaire');