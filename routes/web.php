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

/*Route::get('/', function () {
	return view('welcome');
})->name('home');
Route::post('/contact-message','ContactMessageController@store')->name('contact-message');
Route::get('/modal',function(){
	return view('modal_window');
})->name('contact-message');

Route::get('/idiomas',function(){
	return view('layout');
});*/



Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        return view('layout');
    });

    Route::get('/lang/{lang}', function ($lang) {
        session(['lang' => $lang]);
        //return view('layaout',['lang'=>$lang]);
        return \Redirect::back();
    })->where([
        'lang' => 'en|es|eu'
    ])->name('change_lang');

});