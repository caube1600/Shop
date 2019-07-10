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

Route::get('index',[
 	'as'=>'trang-chu',
 	'uses'=>'PageController@getIndex'
 ])->middleware('CheckLogout');

Route::get('productType/{type}',[
	'as' =>'loaisanpham',
	'uses' => 'PageController@getLoaisp'
]);

Route::get('product/{id}',[
	'as' =>'product',
	'uses'=>'PageController@getProduct'
 ]);
Route::get('contact',[
	'as'=> 'contact',
	'uses'=>'PageController@getContact'
 ]);
Route::get('about',[
	'as'=>'about',
	'uses'=>'PageController@getAbout'
]);

Route::get('addToCart/{id}',[
		'as'=>'Themgiohang',
		'uses'=>'PageController@getaddToCart'
]);

Route::get('deletecart/{id}',[
	'as'=>'Xoagiohang',
	'uses' => 'PageController@getDeleteCart'
]);

Route::get('Checkout',[
	'as'=>'checkout',
	'uses' => 'PageController@getCheckout'
]);

Route::post('Checkout',[
	'as'=>'checkout',
	'uses' => 'PageController@postCheckout'
]);

Route::get('login',[
	'as'=>'login',
	'uses' => 'PageController@getlogin'
]);

Route::post('login',[
	'as'=>'login',
	'uses' => 'PageController@postlogin'
]);

Route::get('signup',[
	'as'=>'signup',
	'uses' => 'PageController@getsignup'
]);

Route::post('signup',[
	'as'=>'signup',
	'uses' => 'PageController@postsignup'
]);

Route::get('logout',[
	'as'=>'logout',
	'uses' => 'PageController@getlogout'
]);

Route::get('search',[
	'as'=>'search',
	'uses' => 'PageController@getsearch'
]);
Route::fallback(function () {
    return redirect('/');
});