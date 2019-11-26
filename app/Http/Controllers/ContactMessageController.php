<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactMessage;

class ContactMessageController extends Controller
{
    public function store(Request $request){
    	$c_message = new ContactMessage;
    	$c_message->nombre = $request->nombre;
    	$c_message->email = $request->email;
    	$c_message->mensaje = $request->mensaje;
    	$c_message->save();
    	return view('welcome');
    }
}
