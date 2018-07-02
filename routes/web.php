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


Route::get('/',['middleware'=>'auth','uses'=>'HomeController@index'] );

Auth::routes();

Route::group(['prefix'=>'users','middleware'=>['auth']],function() {

 Route::get('list','UserController@index')->name('users.index');
 Route::get('/{id}','UserController@show')->name('users.show');
 Route::post('update/{id}','UserController@update')->name('users.update');
 Route::delete('users/{id}','UserController@destroy')->name('users.destroy');
});





