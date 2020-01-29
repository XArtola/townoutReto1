<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Circuit;

class CircuitController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

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
        //return $this->sendResponse(LocationResource::collection($products), 'Locations retrieved succesfully.');
    }
    public function joinedUsers($circuit_id)
    {
        $circuit = Circuit::find($circuit_id);
        $games = $circuit->games;
        $aux = [];
        foreach ($games as $game)
            array_push($aux, $game->user);
        $games = $aux;
        return $this->sendResponse($games, 'Game retrieved succesfully.');

        //return $this->sendResponse($game, 'Game retrieved succesfully.');
    }
    public function getAllCircuits()
    {
        $circuits = Circuit::all();
        return $circuits;
    }
    public function stadistics()
    {
        $circuits = Circuit::all();
        $dates = Array();
        $cont = Array();
        $n_caretaker = Array();
        $n_standard = Array();
        foreach ($circuits as $circuit) 
        {

            $fecha_creacion = $circuit->created_at;
            $date=strtotime($circuit->created_at);
            $string_d = date("Y-m-d", $date);

            if (!in_array($string_d, $dates))
            {
              array_push($dates, $string_d);
              array_push($cont, 1);

              if($circuit->caretaker === 1)
              {
                array_push($n_caretaker, 1);
                array_push($n_standard, 0);
              }
              elseif ($circuit->caretaker === 0)
              {
                  array_push($n_standard, 1);
                  array_push($n_caretaker, 0);
              }
            }
            elseif(in_array($string_d, $dates))
            {
                //Obtener el último dato de $cont[] y guardarlo en una variable c
                $c = end($cont);
               
                //Eliminar el último dato de $cont[]
                array_pop($cont);

                //Sumarle uno a la variable c
                array_push($cont, $c+1);

                if($circuit->caretaker === 1)
                {
                    $c_c = end($n_caretaker);
                    array_pop($n_caretaker);
                    array_push($caretaker, $c_c+1);
                }
                elseif($circuit->caretaker === 0)
                {
                    $c_s = end($n_standard);
                    array_pop($n_standard);
                    array_push($n_standard, $c_s+1);
                }

                
               
            }
        }
        
        return [$dates,$cont,$n_caretaker,$n_standard];

  }
}
