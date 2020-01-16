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
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $locations = Location::all();
        return $this->sendResponse(LocationResource::collection($locations), 'Locations retrieved succesfully.');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        $input = $request->all();
        $input['date'] = now();

        $validator = Validator::make($input, [

            //'latlng' => 'required',
            'lat' => 'required',
            'lng' => 'required',

        ]);

        if($validator->fails()){

            return $this->sendError('Validation Error.', $validator->errors());       

        }

        $location = Location::create($input);

        return $this->sendResponse(new LocationResource($location), 'Location created successfully.');

    } 

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {

        $location = Location::find($id);
  
        if (is_null($location)) {

            return $this->sendError('Location not found.');

        }

        return $this->sendResponse(new LocationResource($location), 'Location retrieved successfully.');

    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Location $location)
    {

        $input = $request->all();

        $validator = Validator::make($input, [

            //'latlng' => 'required',
            'lat' => 'required',
            'lng' => 'required',
        ]);

       if($validator->fails()){

            return $this->sendError('Validation Error.', $validator->errors());       

        }

        //$location->latlng = $input['latlng'];
        $location->game_id = $input['game_id'];
        $location->latlng = $input['lat'];
        $location->latlng = $input['lng'];
        $location->save();

        return $this->sendResponse(new LocationResource($location), 'Location updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Location $location)
    {
        $location->delete();
        return $this->sendResponse([], 'Location deleted successfully.');
    }

       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//Devuelve locations de una game especifica
    public function getLocations($id)
    {

        $locations = Location::where('game_id',$id)->get();
        return $this->sendResponse(LocationResource::collection($locations), 'Locations retrieved succesfully.');

    }

    public function lastLocation($id){
        $location = Location::where('game_id',$id)->last();
        return $this->sendResponse(LocationResource($location));
    }
}
