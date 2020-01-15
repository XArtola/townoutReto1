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

/*Prueb api*/

Route::get('/callApi', 'ImgurController@callApi')->name('callApi');


/*Página principal*/
Route::get('/', function () {
    return view('welcome');
})->middleware('landing')->name('welcome');
/*
Route::get('/', function () {
    return view('welcome');
})->name('welcome');
*/

//Route::post('/contact-message', 'ContactMessageController@store')->name('contact-message');

/*Verificación de email*/

Route::get('/verify/{username}', 'Auth\RegisterController@verifyUser')->name('activate');

Route::group(['middleware' => ['web']], function () {
    Route::get('/verify/{username}', 'Auth\RegisterController@verifyUser')->name('activate');
    Route::get('/verify', function () {
        return view('auth.verify');
    })->name('verify');

    /*Inserción de mensaje de usuario*/
    Route::post('/contact-message', 'ContactMessageController@store')->name('contact-message');

    Route::get('/lang/{lang}', function ($lang) {
        session(['lang' => $lang]);
        //return view('layaout',['lang'=>$lang]);
        return \Redirect::back();
    })->where(['lang' => 'en|es|eu'])->name('change_lang');
    /*User*/
    Route::group(['middleware' => ['auth']], function () {
        /*
        Route::get('/index', 'UserController@index')->name('user.index');
        Route::get('/create', 'UserController@create')->name('user.create');
        Route::post('/store', 'UserController@store')->name('user.store');
        */
        Route::get('/home', 'UserController@home')->name('user.home');
        Route::get('/{username}/show', 'UserController@show')->name('user.show');
        Route::get('/{username}/edit', 'UserController@edit')->name('user.edit');
        Route::put('/{username}/update', 'UserController@update')->name('user.update');
        Route::delete('/{user}/destroy', 'UserController@destroy')->name('user.destroy');

        //Circuits (esta repetido pero no lo borro por si acaso)
        /*
        Route::get('/circuit/create','CircuitController@create')->name('circuit.create');
        Route::post('/circuit/store','CircuitController@store')->name('circuit.store');
        Route::get('/{id}/edit','CircuitController@edit')->name('circuit.edit');
        Route::put('/{id}/update', 'CircuitController@update')->name('circuit.update');
        Route::get('/{id}/show', 'CircuitController@show')->name('circuit.show');
        Route::delete('/{id}/destroy', 'CircuitController@destroy')->name('circuit.destroy');
        */
        
        //Comments
        Route::post('/comment','CommentController@store')->name('comments.store');

        /*Route::resource('games','GameController');*/


        /*Admin sobrarán algunas*/
        //Hay que cambiar las rutas no valen las mismas

        Route::get('/admin', 'AdminController@admin')->name('admin.admin');
        Route::get('/index', 'AdminController@index')->name('admin.index');
        Route::get('/admin/{id}/show', 'AdminController@show')->name('admin.show');

        Route::get('/admin/create', 'AdminController@create')->name('admin.create');
        Route::post('/admin/store', 'AdminController@store')->name('admin.store');

        Route::get('/admin/{id}/edit', 'AdminController@edit')->name('admin.edit');
        Route::put('/admin/{id}/update', 'AdminController@update')->name('admin.update');

        Route::delete('/admin/{user}/destroy', 'AdminController@destroy')->name('admin.destroy');

        Route::put('/messages/{id}/update', 'ContactMessageController@update')->name('messages.update');
        Route::delete('/messages/{id}/destroy', 'ContactMessageController@destroy')->name('messages.destroy');


        //Circuits
        Route::get('/circuit/create', 'CircuitController@create')->name('circuit.create');
        Route::post('/circuit/store', 'CircuitController@store')->name('circuit.store');
        Route::get('/circuit/{id}/edit', 'CircuitController@edit')->name('circuit.edit');
        Route::put('/circuit/{id}/update', 'CircuitController@update')->name('circuit.update');
        Route::put('/circuit/{id}/updatejoinCode', 'CircuitController@updatejoinCode')->name('circuit.updatejoinCode');
        Route::get('/circuit/{id}/show', 'CircuitController@show')->name('circuit.show');
        Route::delete('/circuit/{id}/destroy', 'CircuitController@destroy')->name('circuit.destroy');

        //Creación de fases
        Route::post('/stages', 'StageController@store')->name('stages.store');

        Route::get('/stages/create', function () {
            return view('stages.create');
        })->name('stages.create');

        Route::get('/games/historic', 'GameController@gamesHistoric')->name('games.historic');

        //Games
        Route::get('/games/{id}/show','GameController@show')->name('games.show');
        
        //Games (Caretaker)
        Route::get('/games/join','GameController@joinCaretaker')->name('games.joinCaretaker');
        Route::post('/games/checkCode','GameController@checkCode')->name('games.checkCode');


        Route::get('/games/{id}', 'GameController@index')->name('games.index');
        Route::get('/games/{id}/start', 'GameController@newGame')->name('games.newGame');

        Route::get('/games/{id}/wait', 'GameController@wait')->name('games.wait');
        Route::get('/games/{id}/startCaretaker', 'GameController@startCaretaker')->name('games.startCaretaker');

        Route::get('/games/{id}/destroy', 'GameController@destroy')->name('games.destroy');
        Route::put('/games/{id}/setRating', 'GameController@setRating')->name('games.setRating');

        //Comments
        Route::post('/comment', 'CommentController@store')->name('comments.store');

        /*Route::resource('games','GameController');*/

        Route::get('/map/{circuit_id}', 'StageController@create')->name('map');



        // PARA COGER UNA IMAGEN GUARDADA EN STORAGE/APP/PUBLIC
        Route::get('/storage/{filename}', function ($filename) {
            $path = storage_path('public/' . $filename);

            if (!File::exists($path)) {
                abort(404);
            }

            $file = File::get($path);
            $type = File::mimeType($path);

            $response = Response::make($file, 200);
            $response->header("Content-Type", $type);

            return $response;
        })->name('storage');

        Route::get('/stages/{circuit_id}/create', 'StageController@create')->name('stages.create');
        Route::post('/stages', 'StageController@store')->name('stages.store');
/*
        Route::get('/stages/{circuit_id}/create', function () {
            return view('stages.create');
        })->name('stages.create');

*/
    });



    Auth::routes(['verify' => true]);
});
