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
Route::get('/', function () {
    return view('welcome');
})->middleware('landing')->name('welcome');

/*Verificación de email*/

Route::get('/verify/{username}', 'Auth\RegisterController@verifyUser')->name('activate');

Route::group(['middleware' => ['web']], function () {
    Route::get('/verify/{username}', 'Auth\RegisterController@verifyUser')->name('activate');
    Route::get('/verify', function () {
        return view('auth.verify');
    })->name('verify');

    /*Inserción de mensaje de usuario*/
    Route::post('/contact-message', 'ContactMessageController@store')->name('contact-message');

    /*Traducciones*/
    Route::get('/lang/{lang}', function ($lang) {
        session(['lang' => $lang]);
        return \Redirect::back();
    })->where(['lang' => 'en|es|eu'])->name('change_lang');

    //Todas a lo que se accede a partir de aqui será con autenticación
    Route::group(['middleware' => ['auth']], function () {

        // Usuario normal (jugador)
        Route::get('/home', 'UserController@home')->name('user.home');
        Route::get('/{username}/show', 'UserController@show')->name('user.show');
        Route::get('/{username}/edit', 'UserController@edit')->name('user.edit');
        Route::put('/{username}/update', 'UserController@update')->name('user.update');
        Route::get('/info', 'UserController@info')->name('user.info');
        Route::delete('/{user}/destroy', 'UserController@destroy')->name('user.destroy');

        //Comments
        Route::post('/comment', 'CommentController@store')->name('comments.store');
 
        // Administrador
        Route::get('/admin/stadistics', 'AdminController@getStadistics')->name('admin.stadistics');
        Route::get('/admin', 'AdminController@admin')->name('admin.admin');
        Route::get('/index', 'AdminController@index')->name('admin.index');
        Route::get('/admin/{id}/show', 'AdminController@show')->name('admin.show');

        Route::get('/admin/create', 'AdminController@create')->name('admin.create');
        Route::post('/admin/store', 'AdminController@store')->name('admin.store');

        Route::get('/admin/{id}/edit', 'AdminController@edit')->name('admin.edit');
        Route::put('/admin/{id}/update', 'AdminController@update')->name('admin.update');

        Route::delete('/admin/{user}/destroy', 'AdminController@destroy')->name('admin.destroy');

        Route::get('/admin/stadistics','AdminController@getStadistics')->name('admin.stadistics');
        
        // Mensajes de contacto desde la landing
        Route::put('/messages/{id}/update', 'ContactMessageController@update')->name('messages.update');
        Route::delete('/messages/{id}/destroy', 'ContactMessageController@destroy')->name('messages.destroy');


        //Circuits
        Route::get('/circuit/create', 'CircuitController@create')->name('circuit.create');
        Route::post('/circuit/store', 'CircuitController@store')->name('circuit.store');
        Route::get('/circuit/{circuit}/order', 'CircuitController@order')->name('circuit.order');
        Route::get('/circuit/{id}/edit', 'CircuitController@edit')->name('circuit.edit');
        Route::put('/circuit/{id}/update', 'CircuitController@update')->name('circuit.update');
        Route::put('/circuit/{id}/updatejoinCode', 'CircuitController@updatejoinCode')->name('circuit.updatejoinCode');
        Route::get('/circuit/{id}/show', 'CircuitController@show')->name('circuit.show');
        Route::delete('/circuit/{id}/destroy', 'CircuitController@destroy')->name('circuit.destroy');

        //Creación de fases
        Route::post('/stages', 'StageController@store')->name('stages.store');
        Route::get('/stages/{circuit_id}/create', 'StageController@create')->name('stages.create');

        //Games
        Route::get('/games/{id}/show', 'GameController@show')->name('games.show');
        Route::get('/games/historic', 'GameController@gamesHistoric')->name('games.historic');

        Route::get('/games/{id}/index', 'GameController@index')->name('games.index');
        Route::get('/games/{id}/start', 'GameController@newGame')->name('games.newGame');
        Route::get('/games/{id}/play', 'GameController@play')->name('games.play');
        Route::get('/games/{game}/exit', 'GameController@exit')->name('games.exit');

        Route::get('/games/{id}/wait', 'GameController@wait')->name('games.wait');
        Route::get('/games/{id}/startCaretaker', 'GameController@startCaretaker')->name('games.startCaretaker');
        Route::get('/games/{circuit}/monitor','GameController@monitor')->name('games.monitor');
        Route::put('/games/{circuit}/endCaretaker', 'GameController@endCaretaker')->name('games.endCaretaker');

        Route::get('/games/{id}/destroy', 'GameController@destroy')->name('games.destroy');
        Route::put('/games/{id}/setRating', 'GameController@setRating')->name('games.setRating');

        //Games (Caretaker)
        Route::get('/games/join', 'GameController@joinCaretaker')->name('games.joinCaretaker');
        Route::post('/games/checkCodgames/joine', 'GameController@checkCode')->name('games.checkCode');

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

     });

    Auth::routes(['verify' => true]);
});
