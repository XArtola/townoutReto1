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

    public function index()
    {
        $games = Game::all();
        return $games;
        //$game = Game::find($id);
        //return $this->sendResponse($game, 'Game retrieved succesfully.');
    }

    public function show($id)
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

    public function stadistics()
    {
        $games = Game::all();
        $dates = array();
        $cont = array();
        $n_caretaker = array();
        $n_standard = array();
        foreach ($games as $game) 
        {
            //return $game->circuit->caretaker;

            //$fecha_creacion = $game->created_at;
            $date=strtotime($game->finish_date);
            $string_d = date("Y-m-d", $date);

            if (!in_array($string_d, $dates))
            {
              array_push($dates, $string_d);
              array_push($cont, 1);

              if($game->circuit->caretaker === 1)
              {
                array_push($n_caretaker, 1);
                array_push($n_standard, 0);
              }
              elseif ($game->circuit->caretaker === 0)
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

                if($game->circuit->caretaker === 1)
                {
                    $c_c = end($n_caretaker);
                    array_pop($n_caretaker);
                    array_push($n_caretaker, $c_c+1);
                }
                elseif($game->circuit->caretaker === 0)
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
