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
})->name('home');*/
Route::post('/contact-message','ContactMessageController@store')->name('contact-message');
Route::get('/modal',function(){
	return view('modal_window');
})->name('contact-message');

//Las rutas se encuentran en
// vendor/laravel/framework/src/Illuminate/Routing/Router.php
Auth::routes(['verify' => true]);


Route::group(['middleware' => ['web']], function () {
    Route::get('/verify/{username}', 'Auth\RegisterController@verifyUser')->name('activate');
    Route::get('/verify',function(){
        return view('auth.verify');
    })->name('verify');
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    Route::post('/contact-message','ContactMessageController@store')->name('contact-message');
    
    Route::get('/modal',function(){
        return view('modal_window');
    })->name('contact-message');

    Route::get('/lang/{lang}', function ($lang) {
        session(['lang' => $lang]);
        //return view('layaout',['lang'=>$lang]);
        return \Redirect::back();
    })->where([
        'lang' => 'en|es|eu'
    ])->name('change_lang');

    Route::group(['middleware'=>['auth']],function(){
        Route::get('/index','UserController@index')->name('user.index');
        Route::get('/{username}/show','UserController@show')->name('user.show');
        Route::get('/{username}/edit','UserController@edit')->name('user.edit');
        Route::put('/{username}/update','UserController@update')->name('user.update');
        Route::delete('/{username}/destroy','UserController@destroy')->name('user.destroy');
    });

});
