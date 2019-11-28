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
})->name('home');
Route::post('/contact-message','ContactMessageController@store')->name('contact-message');
Route::get('/modal',function(){
	return view('modal_window');
})->name('contact-message');

Auth::routes();
//Las rutas se encuentran en
//vendor/laravel/framework/src/Illuminate/Routing/Router.php
Route::get('/home', 'HomeController@index')->name('home');
