<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Location;
use App\Game;
use Validator;
use App\Http\Resources\Location as LocationResource;

class LocationController extends BaseController
{
    // Devuelve todas las localizaciones de la base de datos

    public function index()
    {

        $locations = Location::all();
        return $this->sendResponse(LocationResource::collection($locations), 'Locations retrieved succesfully.');
    }

    // Guarda la información correspondienta a una localización en la base de datos 

    public function store(Request $request)
    {

        $input = $request->all();
        $input['date'] = now();

        $validator = Validator::make($input, [

            //'latlng' => 'required',
            'lat' => 'required',
            'lng' => 'required',

        ]);

        if ($validator->fails()) {

            return $this->sendError('Validation Error.', $validator->errors());
        }

        $location = Location::create($input);
        $location->active_circuit = $location->game->circuit->join_code ? true : false;

        return $this->sendResponse($location, 'Location created successfully.');
    }

    // Toma el identificador
    // y devuelve un objeto localización

    public function show($id)
    {

        $location = Location::find($id);

        if (is_null($location)) {

            return $this->sendError('Location not found.');
        }

        return $this->sendResponse(new LocationResource($location), 'Location retrieved successfully.');
    }

    // Actuliza la información de una localización

    public function update(Request $request, Location $location)
    {

        $input = $request->all();

        $validator = Validator::make($input, [

            //'latlng' => 'required',
            'lat' => 'required',
            'lng' => 'required',
        ]);

        if ($validator->fails()) {

            return $this->sendError('Validation Error.', $validator->errors());
        }

        $location->game_id = $input['game_id'];
        $location->latlng = $input['lat'];
        $location->latlng = $input['lng'];
        $location->save();

        return $this->sendResponse(new LocationResource($location), 'Location updated successfully.');
    }

    // Elimina una localización

    public function destroy(Location $location)
    {
        $location->delete();
        return $this->sendResponse([], 'Location deleted successfully.');
    }

    // Toma el identificador de juego y
    // devuelve un objeto con las localizaciones 
    // correspondientes

    public function getLocations($id)
    {

        $locations = Location::where('game_id', $id)->get();
        return $this->sendResponse(LocationResource::collection($locations), 'Locations retrieved succesfully.');
    }

    // Toma el identificador de juego y
    // devuelve un objeto con la última localización 
 
    public function lastLocation($id)
    {
        $location = Location::where('game_id', $id)->latest()->first();
        return $this->sendResponse(new LocationResource($location), 'Locations retrieved succesfully.');
    }
}
