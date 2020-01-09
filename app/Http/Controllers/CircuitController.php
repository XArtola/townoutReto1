<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Circuit;
use Illuminate\Support\Facades\Auth;
use App\User;

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
                'description' => ['required', 'string', 'max:255','regex:/^[A-Za-z0-9ñàèìòùÁÉÍÓÚ\s]+$/'],
                'city' => ['required', 'string', 'max:100'],
                'difficutly'=>['required'],
                'duration'=>['required', 'max:360']
        ]);

        $circuit = new Circuit;
        //$user = Auth::user()->id;
        $circuit->name = $request->name;
        $circuit->description = $request->description;
        $circuit->image = $request->image;
        $circuit->city = $request->city;
        $circuit->dificulty = $request->difficulty;
        $circuit->duration = $request->duration;
        $circuit->caretaker = $request->caretaker == 'on' ? 1 : 0;
        $circuit->user_id = auth()->user()->id;
        //$circuit = $request->all();
        $circuit->save();

        return redirect('/home');
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
        //
    }
}
