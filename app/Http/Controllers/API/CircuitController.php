<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Circuit;

class CircuitController extends Controller
{
 
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $circuit = Location::all();
        return $this->sendResponse(LocationResource::collection($products), 'Locations retrieved succesfully.');
        $circuit = Circuit::find($id);

    }


}
