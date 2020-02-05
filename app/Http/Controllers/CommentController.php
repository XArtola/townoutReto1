<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    // Guardar comentario
    public function store(Request $request)
    {
        // Valida información
        $request->validate([
                'comment' => ['required','string', 'max:500','regex:/^[A-Za-z0-9ñÑáéíóúüçÁÉÍÓÚÜÇ\s\W]+$/']
        ]);

        // Guarda información de comentario
        $comment = new Comment;

        $comment->comment = $request->comment;
        $comment->user_id = auth()->user()->id;
        $comment->circuit_id = $request->circuit_id;
        
        $comment->save();

        return redirect()->route('user.home');
    }

    
}
