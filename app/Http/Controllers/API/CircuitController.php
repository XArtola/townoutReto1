<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Circuit;
use App\Game;

class CircuitController extends BaseController
{

    // Toma el identificador de circuito y
    // devuelve un objeto con la información del
    // circuito y sus etapas

    public function index($id)
    {

        $circuit = Circuit::find($id);
        $stages = $circuit->stages;
        foreach ($stages as $stage) {
            switch ($stage->stage_type) {

                case 'text':
                    $infoStage = $stage->stext()->answer;
                    $stage['answer'] = $infoStage;
                    break;

                case 'quiz':
                    $infoStage = $stage->squiz();
                    $stage['correct_ans'] = $infoStage->correct_ans;
                    $stage['possible_ans1'] = $infoStage->possible_ans1;
                    $stage['possible_ans2'] = $infoStage->possible_ans2;
                    $stage['possible_ans3'] = $infoStage->possible_ans3;
                    break;
            }
        }
        $circuit['stages'] = $stages;
        return $this->sendResponse($circuit, 'Circuits retrieved succesfully.');
    }

    // Toma identificador de circuito tipo caretaker
    // que se está jugando actualmente y devuelve 
    // objeto con los juegos de los participantes

    public function joinedUsers($circuit_id)
    {
        $circuit = Circuit::find($circuit_id);
        $games = Game::where('circuit_id', $circuit_id)->whereNull('start_date')->get(); //$circuit->games;
        $aux = [];
        $game_ids = '';
        foreach ($games as $game) {
            $game->username = $game->user->username;
            array_push($aux, $game);
            $game_ids .= $game->id . '_';
        }
        $games = $aux;

        //guarda en la base de datos los game_ids
        $circuit->game_ids = $game_ids;
        $circuit->save();
        return $this->sendResponse(['games' => $games, 'game_ids' => $game_ids], 'Game retrieved succesfully.');
    }
    public function getAllCircuits()
    {
        $circuits = Circuit::all();
        return $circuits;
    }
    public function stadistics()
    {
        $circuits = Circuit::all();
        $dates = array();
        $cont = array();
        $n_caretaker = array();
        $n_standard = array();
        foreach ($circuits as $circuit) {

            $fecha_creacion = $circuit->created_at;
            $date = strtotime($circuit->created_at);
            $string_d = date("Y-m-d", $date);

            if (!in_array($string_d, $dates)) {
                array_push($dates, $string_d);
                array_push($cont, 1);

                if ($circuit->caretaker == 1) {
                    array_push($n_caretaker, 1);
                    array_push($n_standard, 0);
                } elseif ($circuit->caretaker == 0) {
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

                if ($circuit->caretaker == 1) {
                    $c_c = end($n_caretaker);
                    array_pop($n_caretaker);
                    array_push($n_caretaker, $c_c + 1);
                } elseif ($circuit->caretaker == 0) {
                    $c_s = end($n_standard);
                    array_pop($n_standard);
                    array_push($n_standard, $c_s + 1);
                }
            }
        }

        return [$dates, $cont, $n_caretaker, $n_standard];
    }
}
