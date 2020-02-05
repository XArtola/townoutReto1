<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stage;
use Auth;
use Storage;
use App\Circuit;
use GuzzleHttp\Client;

class StageController extends Controller
{

    // Devuelve vista de creación de de prueba
    public function create(Circuit $circuit_id)
    {
        if ($circuit_id->user_id === Auth()->user()->id)
            return view('stages.create')->with('circuit', $circuit_id);
        else
            return redirect()->route('user.home');
    }

    // Guarda la información de una prueba en la base de datos
    public function store(Request $request)
    {
        // Validación de los campos
        $request->validate([
            'question_text' => 'required|max:255',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'circuit_id' => 'required|numeric'
        ]);

        //Guarda la informamación
        $stage = new Stage;
        $stage->question_text = $request->question_text;
        $stage->lat = $request->lat;
        $stage->lng = $request->lng;

        $stage->order = Stage::where('circuit_id', $request->circuit_id)->get() ? Stage::where('circuit_id', $request->circuit_id)->max('order') + 1 : 0;
        $stage->circuit_id = $request->circuit_id;

        // Si existe información de la imagen guardarla en imgur
        if (isset($request->question_image)) {
            $file = $request->file('question_image');
            $client = new \GuzzleHttp\Client();

            $response = $client->request('POST', 'https://api.imgur.com/3/upload', [
                'headers' => [
                    'authorization' => 'Bearer b9ef1e8c0d7dd3fa4f4ea534a6f6856eaea692e8',
                    'content-type' => 'application/x-www-form-urlencoded',
                ], 'form_params' => [
                    'image' => base64_encode(file_get_contents($request->file('question_image')->path())),

                ],
            ]);

            $stage->question_image = json_decode(($response->getBody()->getContents()), true)['data']['link'];
        }
        
        // Guardado de la información dependiendo del tipo de prueba
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
        return redirect()->route('stages.create', ['circuit_id' => $stage->circuit->id]);
    }

}
