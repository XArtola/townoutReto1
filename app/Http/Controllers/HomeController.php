<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Aplica middleware auth
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Devuelve la vista home
    public function index()
    {
        return view('home');
    }
}
