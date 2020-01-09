<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('locations', 'API\LocationController');
Route::group(['middleware' => 'cors'], function(){
    //aqui van todas las rutas que necesitan CORS
    Route::get('/circuits/{id}', 'API\CircuitController@index');
}); 
