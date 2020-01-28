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
        if ($game->user_id === Auth()->user()->id && $game->start_date == null) {
            $game->start_date = now();
            $game->save();
            return redirect()->route('games.play', $id);
        } else
            return view('user.home');
    }
    //Devuelve la vista de juego
    public function play($id)
    {
        $game = Game::find($id);
        if ($game->user_id === Auth()->user()->id && $game->start_date != null && $game->finish_date == null) {
            return view('games.index', compact('game'));
        } else
            return view('user.home');
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
        if ($game->user_id === Auth()->user()->id)
            return view('games.show')->with(compact('game'));
        else
            return redirect()->route('user.home');
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

    //Devuelve la vista de espera para unirse a partida caretaker
    public function wait($id)
    {
        $game = Game::find($id);
        //Comprueba que el juego pertenece al usuario y que no está finalizado ni empezado
        if ($game->user_id === Auth()->user()->id && $game->circuit->caretaker == 1 && $game->finish_date === null && $game->start_date === null)
            return view('games.wait', compact('game'));
        else
            return redirect()->route('user.home');
    }

    //Inicia partida caretaker
    public function startCaretaker($id)
    {
        $circuit = Circuit::find($id);
        //Busca circuito del código correspondiente
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
    //Carga vista de monitoring
    public function monitor(Circuit $circuit)
    {
        return view('games.monitoring')->with('circuit', $circuit)->with('games', Game::where('circuit_id', $circuit->id)->where('finish_date', null)->get());
    }

    //Termina sesión caretaker
    public function endCaretaker(Circuit $circuit)
    {
        $circuit->join_code = null;
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

    //Mostrar vista de historico de juegos

    public function gamesHistoric()
    {
        $games = Game::All();
        return view('games.historic', compact('games'));
    }
    //Terminar una partida
    public function exit(Game $game)
    {
        //Solo dejara salir terminar la partida si el usuario que hace la petición
        //es el del juego y si el juego no está terminado
        if ($game->finish_date === null && $game->user_id === Auth()->user()->id) {
            $game->finish_date = now();
            $game->save();
        }
        return redirect()->route('user.home');
    }
}
