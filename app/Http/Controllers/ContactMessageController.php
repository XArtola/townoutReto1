<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactMessage;
use App\Http\Requests\SuggestionRequest;

class ContactMessageController extends Controller
{

	// Guarda infomación de mensajes de contacto
	public function store(SuggestionRequest $request)
	{
		$c_message = new ContactMessage;
		$c_message->nombre = $request->nombre;
		$c_message->apellido = $request->apellido;
		$c_message->email = $request->email;
		$c_message->mensaje = $request->mensaje;
		$c_message->save();
		return view('welcome');
	}

	// Actualiza información estado de mensaje
	public function update($id, Request $request)
	{
		$c_message = ContactMessage::find($id);
		$c_message->active = $request->active;
		$c_message->save();
		return redirect()->route('admin.admin');

	}

	// Elimina mensaje
	public function destroy($id)
	{
		$c_message = ContactMessage::find($id);
		$c_message->delete();
		return redirect()->route('admin.admin');

	}
}
