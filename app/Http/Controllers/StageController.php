<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stage;
use Auth;
use Storage;
use App\Circuit;
class StageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($circuit_id)
    {
        $circuit = Circuit::find($circuit_id);
        return view('stages.create')->with(compact('circuit'));
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
            'question_text' => 'required|max:255',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'order' => 'required|numeric',
            'circuit_id' => 'required|numeric'
        ]);
        $stage = new Stage;
        $stage->question_text = $request->question_text;
        $stage->lat = $request->lat;
        $stage->lng = $request->lng;

        $stage->order = $request->order;
        $stage->circuit_id = $request->circuit_id;

        if (isset($request->question_image)) {
            $file = $request->file('question_image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $request->file('question_image')->storeAs('public/stages',$filename);           
            $stage->question_image = $filename;
        }
        
        switch ($request->stage_type) {

            case 'text':

                $request->validate([
                    'answer' => 'required|max:255',

                ]);

                $stage->stage_type = 'text';
                $stage->save();

                $stage->setAnswer($request->answer);

                break;

            case 'quiz':
                $request->validate([
                    'correct_ans' => 'required|max:150',
                    'possible_ans1' => 'required|max:150',
                    'possible_ans2' => 'required|max:150',
                    'possible_ans2' => 'max:150',
                ]);

                $stage->stage_type = 'quiz';
                $stage->save();
                $stage->setCorrect_ans($request->correct_ans);
                $stage->setPossible_ans1($request->possible_ans1);
                $stage->setPossible_ans2($request->possible_ans2);
                $stage->setPossible_ans3($request->possible_ans3);

                break;

            case 'img':
                $stage->stage_type = 'img';
                $stage->save();
                break;
        }
        return redirect()->route('stages.create',['circuit_id'=>$stage->circuit->id]);
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
