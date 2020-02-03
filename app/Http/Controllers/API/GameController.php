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
    // Toma el identificador de un juego
    // y devuelve un objeto con la información

   public function index($id)
    {
        $game = Game::find($id);
        return $this->sendResponse($game, 'Game retrieved succesfully.');
    }

    // Actuliza la información de un juego

    public function update(Request $request, Game $game)
    {

        // Busca el juego
        $game = Game::find($request['id']);

        // Guarda la información del request
        $input = $request->all();
        
        // Actualiza la infomación
        $game->start_date = $input['start_date'];
        $game->finish_date = $input['finish_date'];
        if ($game->finish_date)
            $game->finish_date = now();
        $game->circuit_id = $input['circuit_id'];
        $game->score = $input['score'];
        $game->user_id = $input['user_id'];
        $game->phase = $input['phase'];
        
        // Guarda los cambios
        $game->save();

        return $this->sendResponse($game, 'Game updated successfully.');
    }

    // Toma un string con los identificadores de los juegos necesarios
    // devuelve un objeto con la información
 
    public function activeGames($game_ids)
    {
        // Crea un array para guardar juegos
        $active_games = [];

        // Deshace el string con los identidficadores separados por "_"
        $game_ids_array = explode('_',$game_ids);

        // Guarda los objetos juego en el array
        // correspondientes a los id
        foreach($game_ids_array as $game_id){
            if($game_id != '')
                array_push($active_games,Game::find($game_id)->first());
        }
        // Añade última localización correspondiente al juego a cada objeto
        foreach($active_games as $game){
            $game->last_location = Location::where('game_id',$game->id)->latest()->first();
        }
        return $this->sendResponse($active_games, 'Games retrieved succesfully.');
    }

}
