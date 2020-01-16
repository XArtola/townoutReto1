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
Route::get('/markers/{circuit_id}','API\StageController@markers');

Route::apiResource('locations', 'API\LocationController');
Route::get('/locations/{id}/getLocations', 'API\LocationController@getLocations');
Route::get('/locations/{id}/lastLocation','API\LocationController@lastLocation');


Route::group(['middleware' => 'cors'], function(){
    //aqui van todas las rutas que necesitan CORS
    Route::get('/circuits/{id}', 'API\CircuitController@index');
    Route::get('/circuits/{id}/joinedUsers', 'API\CircuitController@joinedUsers');
    Route::get('/games/{id}/get', 'API\GameController@index');
    Route::put('/games/{id}', 'API\GameController@update');


}); 
