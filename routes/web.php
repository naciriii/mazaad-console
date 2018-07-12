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

Route::group(['middleware' => ['auth']],function() {

Route::group(['prefix'=>'users'],function() {

 Route::get('list','UserController@index')->name('users.index');
 Route::get('/{id}','UserController@show')->name('users.show');
 Route::post('update/{id}','UserController@update')->name('users.update');
 Route::delete('users/{id}','UserController@destroy')->name('users.destroy');
});

Route::resource('categories','CategoryController');
Route::resource('regions','RegionController');

Route::get('products/validate/{id}','ProductController@validateProduct')->name('products.validate');
Route::resource('products','ProductController');

Route::group(['prefix'=>'complaints'],function() {

 Route::get('/','ComplaintController@index')->name('complaints.index');
 Route::get('/{id}','ComplaintController@show')->name('complaints.show');
  Route::post('answer','ComplaintController@answer')->name('complaints.answer');

 Route::delete('{id}','ComplaintController@destroy')->name('complaints.destroy');
});

Route::group(['prefix'=>'auctions'],function() {

	  Route::get('/delete/{id}','AuctionController@show')->name('auctions.show');
	   Route::get('/edit/{id}','AuctionController@edit')->name('auctions.edit');
	   	   Route::post('/update/{id}','AuctionController@update')->name('auctions.update');

	 Route::delete('/bid/{bid_id}','AuctionController@destroy')->name('auctions.destroy');
		 Route::get('/list/{product_id}','AuctionController@index')->name('auctions.index');

	});



});





