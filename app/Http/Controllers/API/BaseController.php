<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;


class BaseController extends Controller
{

   
   // Devuelve la respuesta de forma estructurada
   // succes: La llamada ha sido un exito
   // data: Información de la respuesta
   // message: Mensaje referente a la respuesta
   
    public function sendResponse($result, $message)
    {
    	$response = [

            'success' => true,
            'data'    => $result,
            'message' => $message,

        ];

        return response()->json($response, 200);
    }


    // Devuelve el error forma estructurada
    // succes: La llamada ha sido un exito
    // data: Información de la respuesta
    // message: Mensaje referente a la respuesta
  
    public function sendError($error, $errorMessages = [], $code = 404)
    {

    	$response = [

            'success' => false,
            'message' => $error,
        ];

        if(!empty($errorMessages)){

            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}