<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Stage;

class StageController extends Controller
{
    public function markers($circuit_id)
    {
    	$stages = Stage::where('circuit_id',$circuit_id)->get();
    	$markers = [];
    	foreach($stages as $stage){
    		array_push($markers,[$stage->lat,$stage->lng]);
    	}
    	$response = [
    		'data' => $markers
    	];
    	return response()->json($response, 200);
    }

    public function order(Request $request, $stage){
        if($request->order && $stage){
            $stage = Stage::find($stage);
            $stage->order = intval($request->order);
            $stage->save();
            return $stage;
        }else{
            abort(400); //bad request
        }
    }
}
