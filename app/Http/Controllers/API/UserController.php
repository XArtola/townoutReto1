<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\User;
use Validator;
use App\Http\Resources\User as UserResource;

class UserController extends BaseController
{
    public function stadistics()
    {
        $users = User::all();
        $dates = array();
        $cont = array();

        foreach ($users as $user) {

            //$f_verificacion = $circuit->created_at;
            $date = strtotime($user->email_verified_at);
            $string_d = date("Y-m-d", $date);

            if (!in_array($string_d, $dates)) {
                array_push($dates, $string_d);
                array_push($cont, 1);
            } elseif (in_array($string_d, $dates)) {
                //Obtener el último dato de $cont[] y guardarlo en una variable c
                $c = end($cont);

                //Eliminar el último dato de $cont[]
                array_pop($cont);

                //Sumarle uno a la variable c
                array_push($cont, $c + 1);
            }
        }

        return [$dates, $cont];
    }
}
