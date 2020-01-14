<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Circuit;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Game;

class CircuitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $circuits=Circuit::all();
        return view ('user.home',compact('circuits'));
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
                'description' => ['required', 'string', 'max:500','regex:/^[A-Za-z0-9ñàèìòùÁÉÍÓÚ\s\W]+$/'],
                'city' => ['required', 'string','max:100'],
                'difficulty'=>['required'],
                'duration'=>['required', 'integer','max:360','min:5']
        ]);

        $circuit = new Circuit;
        $circuit->name = $request->name;
        $circuit->description = $request->description;

        if (isset($request->image)) {
            $file = $request->file('image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $request->file('image')->storeAs('public/circuits',$filename);
            $circuit->image = $filename;
        }

        $circuit->city = $request->city;
        $circuit->difficulty = $request->difficulty;
        $circuit->duration = $request->duration;
        $circuit->caretaker = $request->caretaker == 'on' ? 1 : 0;
        $circuit->user_id = auth()->user()->id;
        
        $circuit->save();
        //return $circuit->id;
        return redirect()->route('stages.create',['circuit_id'=>$circuit->id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //Esto está programado especificamente para la vista startCaretaker
        //Si se hacen cambios tomar en cuenta que tambien habrá que hacerlos en esa vista
        $circuit = Circuit::find($request->id);
        //return $circuit;
        $circuit->join_code = $request->join_code;
        $circuit->save();

        return redirect()->route('games.monitoring',[
            'circuit_id'=> $id
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
        //
    }
}
