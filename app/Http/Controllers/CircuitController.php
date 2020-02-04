<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Circuit;
use Illuminate\Support\Facades\Auth;
use App\User;
use GuzzleHttp\Client;

class CircuitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $circuits = Circuit::all();
        return view('user.home', compact('circuits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('circuit.create');
    }

    public function  order(Circuit $circuit)
    {
        return view('circuit.order')->with('circuit',$circuit);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:100', 'regex:/^[A-Za-z0-9ñàèìòùÁÉÍÓÚ\s]+$/'],
            'description' => ['required', 'string', 'max:500', 'regex:/^[A-Za-z0-9ñàèìòùÁÉÍÓÚ\s\W]+$/'],
            'city' => ['required', 'string', 'max:100', 'regex:/^[A-Za-zñàèìòùÁÉÍÓÚ\s]+$/'],
            'difficulty' => ['required'],
            'duration' => ['required', 'integer', 'max:360', 'min:5'],
            'lang' => ['regex:/^es|en|eus$/']
        ]);

        $circuit = new Circuit;
        $circuit->name = $request->name;
        $circuit->description = $request->description;

        if (isset($request->image)) {

            $file = $request->file('image');
            /*
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $request->file('image')->storeAs('public/circuits', $filename);
*/
            $client = new \GuzzleHttp\Client();

            $response = $client->request('POST', 'https://api.imgur.com/3/image', [
                'headers' => [
                    'authorization' => 'Client-ID ' . '4a7bfbb21921629',
                    'content-type' => 'application/x-www-form-urlencoded',
                    'acces-token' => 'b9ef1e8c0d7dd3fa4f4ea534a6f6856eaea692e8'
                ], 'form_params' => [
                    'image' => base64_encode(file_get_contents($request->file('image')->path())),

                ],
            ]);

            //return response()->json(json_decode(($response->getBody()->getContents())));


            $circuit->image = json_decode(($response->getBody()->getContents()), true)['data']['link'];
        }

        $circuit->city = $request->city;
        $circuit->difficulty = $request->difficulty;
        $circuit->duration = $request->duration;
        $circuit->caretaker = $request->caretaker == 'on' ? 1 : 0;
        $circuit->user_id = auth()->user()->id;
        $circuit->lang = $request->lang;

        $circuit->save();
        //return $circuit->id;
        return redirect()->route('stages.create', ['circuit_id' => $circuit->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Dirige a la vista menu caretaker. 
        $circuit = Circuit::find($id);

        $random_code = substr(str_shuffle(str_repeat('0123456789', 5)), 0, 5);

        return view('circuit.show')->with(compact('circuit'))->with(compact(('random_code')));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $circuit = Circuit::find($id);
        //Si el user id del circuito coincide con el usuario autenticado
        if ($circuit->user->id === auth()->user()->id) {
            return view('circuit.edit')->with(compact('circuit'));
        } else
        return redirect('/home');
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
        $request->validate([
            'name' => ['required', 'string', 'max:100', 'regex:/^[A-Za-z0-9ñàèìòùÁÉÍÓÚ\s]+$/'],
            'description' => ['required', 'string', 'max:500', 'regex:/^[A-Za-z0-9ñàèìòùÁÉÍÓÚ\s\W]+$/'],
            'city' => ['required', 'string', 'max:100', 'regex:/^[A-Za-zñàèìòùÁÉÍÓÚ\s]+$/'],
            'difficulty' => ['required'],
            'duration' => ['required', 'integer', 'max:360', 'min:5'],
            'lang' => ['regex:/^es|en|eus$/']
        ]);

        $circuit = Circuit::find($id);
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

        return redirect('/home');
    }

    public function updatejoinCode(Request $request, $id)
    {
        //Esto está programado especificamente para la vista startCaretaker
        //Si se hacen cambios tomar en cuenta que tambien habrá que hacerlos en esa vista
        $circuit = Circuit::find($id);
        //return $circuit;
        $circuit->join_code = $request->join_code;
        $circuit->save();
        return redirect()->route('games.monitor',[
            'circuit'=>$circuit->id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Circuit::find($id)->delete();
        return redirect()->route('user.home');
    }
}
