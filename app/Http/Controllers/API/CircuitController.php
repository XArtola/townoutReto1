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
}
