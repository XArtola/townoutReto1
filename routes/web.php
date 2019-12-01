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
/*Página principal*/
Route::get('/', function ($notification) {
    return view('welcome');
})->name('welcome');


//Route::post('/contact-message', 'ContactMessageController@store')->name('contact-message');

/*Verificación de email*/

Route::get('/verify/{username}', 'Auth\RegisterController@verifyUser')->name('activate');

Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        return view('welcome');
    })->name('home');
    /*Inserción de mensaje de usuario*/
    Route::post('/contact-message', 'ContactMessageController@store')->name('contact-message');

    Route::get('/modal', function () {
        return view('modal_window');
    })->name('contact-message');

    Route::get('/lang/{lang}', function ($lang) {
        session(['lang' => $lang]);
        //return view('layaout',['lang'=>$lang]);
        return \Redirect::back();
    })->where([
        'lang' => 'en|es|eu'
    ])->name('change_lang');

    Route::get('/{user}/show', 'UserController@show')->name('user.show');

    Auth::routes(['verify' => true]);
    Route::get('/verify', function () {
        return view('auth.verify');
    })->name('verify');
});
