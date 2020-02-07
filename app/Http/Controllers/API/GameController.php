<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Game;
use App\Circuit;
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

    // Toma un objeto Circuito y
    // devuelve un objeto con la información de los juegos activos

    public function activeGames(Circuit $circuit)
    {
        // Crea un array para guardar juegos
        $active_games = [];
        // Separa los id del campo game_ids
        $game_ids_array = explode('_',$circuit->game_ids);
        // guarda el juego correspondiente 
        // a cada id en el array
        foreach($game_ids_array as $game_id){
            if($game_id != '')
                array_push($active_games,Game::find($game_id));
        }
        // Guarada la última localizacioón del juego en un campo del objeto
        foreach($active_games as $game){
            $game->last_location = Location::where('game_id',$game->id)->latest();
        }
        return $this->sendResponse($active_games, 'Games retrieved succesfully.');
    }

    public function stadistics()
    {
        $games = Game::all();
        $dates = array();
        $cont = array();
        $n_caretaker = array();
        $n_standard = array();
        foreach ($games as $game) {
            //return $game->circuit->caretaker;

            //$fecha_creacion = $game->created_at;
            $date = strtotime($game->finish_date);
            $string_d = date("Y-m-d", $date);

            if (!in_array($string_d, $dates)) {
                array_push($dates, $string_d);
                array_push($cont, 1);

                if ($game->circuit->caretaker == 1) {
                    array_push($n_caretaker, 1);
                    array_push($n_standard, 0);
                } elseif ($game->circuit->caretaker == 0) {
                    array_push($n_standard, 1);
                    array_push($n_caretaker, 0);
                }
            } elseif (in_array($string_d, $dates)) {
                //Obtener el último dato de $cont[] y guardarlo en una variable c
                $c = end($cont);

                //Eliminar el último dato de $cont[]
                array_pop($cont);

                //Sumarle uno a la variable c
                array_push($cont, $c + 1);

                if ($game->circuit->caretaker == 1) {
                    $c_c = end($n_caretaker);
                    array_pop($n_caretaker);
                    array_push($n_caretaker, $c_c + 1);
                } elseif ($game->circuit->caretaker == 0) {
                    $c_s = end($n_standard);
                    array_pop($n_standard);
                    array_push($n_standard, $c_s + 1);
                }
            }
        }

        return [$dates, $cont, $n_caretaker, $n_standard];
    }
}
