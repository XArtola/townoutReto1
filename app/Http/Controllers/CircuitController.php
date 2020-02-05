<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Circuit;
use Illuminate\Support\Facades\Auth;
use App\User;
use GuzzleHttp\Client;

class CircuitController extends Controller
{

    // Devuelve la vista de usuario con la información de los circuitos

    public function index()
    {
        $circuits = Circuit::all();
        return view('user.home', compact('circuits'));
    }

    // Devuelve la vista de creación de circuitos

    public function create()
    {
        return view('circuit.create');
    }

    // Devuelve la vista de ordenación de circuitos

    public function  order(Circuit $circuit)
    {
        return view('circuit.order')->with('circuit', $circuit);
    }

    // Guarda la información de un circuto

    public function store(Request $request)
    {

        // Validación de campos
        $request->validate([
            'name' => ['required', 'string', 'max:100', 'regex:/^[A-Za-z0-9ñàèìòùÁÉÍÓÚ\s]+$/'],
            'description' => ['required', 'string', 'max:500', 'regex:/^[A-Za-z0-9ñàèìòùÁÉÍÓÚ\s\W]+$/'],
            'city' => ['required', 'string', 'max:100', 'regex:/^[A-Za-zñàèìòùÁÉÍÓÚ\s]+$/'],
            'difficulty' => ['required'],
            'duration' => ['required', 'integer', 'max:360', 'min:5'],
            'lang' => ['regex:/^es|en|eus$/']
        ]);

        // Guarda la información del circuito
        $circuit = new Circuit;
        $circuit->name = $request->name;
        $circuit->description = $request->description;

        // Si el campo de img del formulario contiene información 
        // guarda la img en imgur
        if (isset($request->image)) {

            $file = $request->file('image');

            $client = new \GuzzleHttp\Client();

            $response = $client->request('POST', 'https://api.imgur.com/3/image', [
                'headers' => [
                    'authorization' => 'Bearer b9ef1e8c0d7dd3fa4f4ea534a6f6856eaea692e8',
                    'content-type' => 'application/x-www-form-urlencoded',
                ], 'form_params' => [
                    'image' => base64_encode(file_get_contents($request->file('image')->path())),

                ],
            ]);

            $circuit->image = json_decode(($response->getBody()->getContents()), true)['data']['link'];
        }

        // Guarda la información del circuito
        $circuit->city = $request->city;
        $circuit->difficulty = $request->difficulty;
        $circuit->duration = $request->duration;
        $circuit->caretaker = $request->caretaker == 'on' ? 1 : 0;
        $circuit->user_id = auth()->user()->id;
        $circuit->lang = $request->lang;

        $circuit->save();

        return redirect()->route('stages.create', ['circuit_id' => $circuit->id]);
    }

    // Devuelve la vista caretaker monitoring

    public function show($id)
    {
        //Dirige a la vista menu caretaker. 
        $circuit = Circuit::find($id);

        $random_code = substr(str_shuffle(str_repeat('0123456789', 5)), 0, 5);

        return view('circuit.show')->with(compact('circuit'))->with(compact(('random_code')));
    }

    // Devuelve la vista de edición de circuito

    public function edit($id)
    {
        $circuit = Circuit::find($id);
        // Si el user id del circuito coincide con el usuario autenticado
        if ($circuit->user->id === auth()->user()->id) {
            return view('circuit.edit')->with(compact('circuit'));
        } else
            return redirect()->route('user.home');
    }

    // Actualiza el circuito

    public function update(Request $request, $id)
    {
        // valida los campos
        $request->validate([
            'name' => ['required', 'string', 'max:100', 'regex:/^[A-Za-z0-9ñàèìòùÁÉÍÓÚ\s]+$/'],
            'description' => ['required', 'string', 'max:500', 'regex:/^[A-Za-z0-9ñàèìòùÁÉÍÓÚ\s\W]+$/'],
            'city' => ['required', 'string', 'max:100', 'regex:/^[A-Za-zñàèìòùÁÉÍÓÚ\s]+$/'],
            'difficulty' => ['required'],
            'duration' => ['required', 'integer', 'max:360', 'min:5'],
            'lang' => ['regex:/^es|en|eus$/']
        ]);

        // Busca el circuito con el identificador    
        $circuit = Circuit::find($id);

        // guarda los valores que existan en el formulario
        if ($request->name)
            $circuit->name = $request->name;
        if ($request->description)
            $circuit->description = $request->description;
        if (isset($request->image)) {
            $file = $request->file('image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $request->file('image')->storeAs('public/circuits', $filename);
            $circuit->image = $filename;
        }
        $circuit->lang = $request->lang;

        if ($request->city)
            $circuit->city = $request->city;
        if ($request->difficulty)
            $circuit->difficulty = $request->difficulty;
        if ($request->duration)
            $circuit->duration = $request->duration;
        if ($request->caretaker)
            $circuit->caretaker = $request->caretaker == 'on' ? 1 : 0;
        if ($request->join_code)
            $circuit->join_code = $request->join_code;
        $circuit->save();

        return redirect()->route('user.home');
    }

    // Actuliza la clave de unirse a la partida de un circuito

    public function updatejoinCode(Request $request, $id)
    {
        $circuit = Circuit::find($id);
        $circuit->join_code = $request->join_code;
        $circuit->save();
        return redirect()->route('games.monitor', [
            'circuit' => $id,
            'game_ids' => $request->game_ids
        ]);
    }

    // Elimina un circuito

    public function destroy($id)
    {
        Circuit::find($id)->delete();
        return redirect()->route('user.home');
    }
}
