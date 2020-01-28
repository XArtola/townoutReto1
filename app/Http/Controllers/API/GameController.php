<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Game;
use App\Location;
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
        $game->score = $input['score'];
        $game->user_id = $input['user_id'];
        $game->phase = $input['phase'];
        $game->save();

        return $this->sendResponse($game, 'Game updated successfully.');
    }

    public function activeGames($game_ids)
    {
        $playing_games = str_split($game_ids);
        return $playing_games;
        $active_games = Game::where('circuit_id',$circuit_id)->whereNull('finish_date')->get();

        foreach($active_games as $game){
            $game->last_location = Location::where('game_id',$game->id)->latest()->first();
        }
        return $this->sendResponse($active_games, 'Games retrieved succesfully.');
    }

}
