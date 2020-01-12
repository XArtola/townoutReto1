<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Game;
use Validator;
use App\Http\Resources\Location as LocationResource;

class GameController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($id)
    {
        $game = Game::find($id);
        return $this->sendResponse($game, 'Game retrieved succesfully.');
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

        if ($validator->fails()) {

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

    public function update(Request $request, Game $game)
    {

        $game = Game::find($request['id']);
        $input = $request->all();
        /*
        $validator = Validator::make($input, [

            //'latlng' => 'required',
            'lat' => 'required',
            'lng' => 'required',
        ]);

       if($validator->fails()){

            return $this->sendError('Validation Error.', $validator->errors());       

        }
*/
        //$location->latlng = $input['latlng'];
        $game->start_date = $input['start_date'];
        $game->finish_date = $input['finish_date'];
        if ($game->finish_date)
            $game->finish_date = now();
        $game->circuit_id = $input['circuit_id'];
        $game->user_id = $input['user_id'];
        $game->phase = $input['phase'];
        $game->save();

        return $this->sendResponse($game, 'Location updated successfully.');
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
}
