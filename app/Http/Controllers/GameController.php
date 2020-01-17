<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;
use Illuminate\Support\Facades\Auth;
use App\Circuit;
use Illuminate\Support\Str;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //poner start date
        $game = Game::find($id);
        $game->start_date = now();
        $game->save();
        return view('games.index', compact('game'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $game = Game::find($id);
        return view('games.show')->with(compact('game'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $game = Game::find($id);
        $game->delete();
        return redirect()->route('user.home');
    }

    //Genera una instancia de Game en el caso de que exista uno
    public function newGame($id)
    {
        $currentGame = Game::where('user_id', Auth::user()->id)->where('finish_date', null)->get();
        //count($currentGame);
        if (count($currentGame) != 0)
            return redirect()->route('user.home');
        else {
            $game = new Game();
            //$game->start_date = now();
            $game->user_id = Auth::user()->id;
            $game->circuit_id = $id;
            $game->save();
           // return $game->circuit;
            if ($game->circuit->caretaker == 0)
                return redirect()->route('games.index', $game->id);
            elseif ($game->circuit->caretaker == 1)
                return redirect()->route('games.wait', ['id' => $game->id]);
        }
    }
    //Devuelve vista de inserción de código
    public function joinCaretaker()
    {
        return view('games.join');
    }
    //Comprueba si existe un circuito con ese código y si existe crea un Game
    public function checkCode(Request $request)
    {
        $validatedData = $request->validate([
            'caretaker_code_input' => 'required|max:6|min:6',
        ]);

        $circuit = Circuit::where('join_code', $request->caretaker_code_input)->first();
        if ($circuit)

            return redirect()->route('games.newGame', ['id' => $circuit->id]);

        else

            return view('games.join', ['code_error' => 'No existe ninguna partida con ese código']);
    }

    //Devuelve vista wait
    public function wait($id)
    {
        $game = Game::find($id);
        return view('games.wait', compact('game'));
    }
    //Inicia partida caretaker
    public function startCaretaker($id)
    {
        $circuit = Circuit::find($id);
        if ($circuit->join_code === null) {
            $random = Str::random(6);
            $circuit->join_code = $random;
            $circuit->save();
            return view('games.startCaretaker', compact('circuit'));
        } elseif ($circuit->join_code === 'START') {
            return redirect()->back();
        } else
            return view('games.startCaretaker', compact('circuit'));
    }


    public function monitor(Circuit $circuit){
        return view('games.monitoring')->with('circuit',$circuit)->with('games',Game::where('circuit_id',$circuit->id)->where('finish_date',null)->get());
    }

    public function endCaretaker(Circuit $circuit)
    {
        $circuit->join_code === null;
        $circuit->finish_date === now();
        $circuit->save();
        return redirect()->route('user.home'); // ------------------ AQUÍ REDIRIGIRÁ A EL RANKING
    }

    //Insertar rating
    public function setRating(Request $request, $id)
    {
        $game = Game::find($id);
        $game->rating = $request->rating;
        $game->save();
        return redirect()->route('games.show', compact('id'));
    }

    //Historico de juegos

    public function gamesHistoric()
    {
        $games = Game::All();
        return view('games.historic', compact('games'));
    }
    public function exit(Game $game)
    {
        $game->finish_date = now();
        $game->save();
        return redirect('/home');
    }
}
