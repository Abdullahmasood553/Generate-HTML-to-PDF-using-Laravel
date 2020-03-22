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



Route::get('users', 'UserController@index');
Route::post('save_user', 'UserController@save_user');
Route::get('userFetchList', 'UserController@userFetchList');
Route::get('total_users', 'UserController@totalUsers');
Route::get('pdf', 'UserController@pdf')->name('pdf');