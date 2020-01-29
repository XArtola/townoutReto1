<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mail;
use Illuminate\Support\Facades\URL;
use App\User;
use App\Circuit;

class UserController extends Controller
{
    //Da acceso solamente a ususarios autenticados y con rol usuario
    //(admin no podran visualizar estas vistas)
    public function __construct()
    {
        $this->middleware(['auth', 'role:user']);
    }

    public function home()
    {
        $circuits = Circuit::where('lang', app()->getLocale())->get();
        return view('user.home')->with('user', User::where('username', auth()->user()->username)->first())->with(compact('circuits'));
    }
 
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($username)
    {
        //Sustituir en un futuro por policies
        if ($username === Auth()->user()->username)
            return view('user.show')->with('user', User::where('username', $username)->first());
        else
            return redirect()->route('user.home');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($username)
    {
        $user = User::where('username', $username)->first();
        if (Auth::user()->username == $user->username) {
            return view('user.edit')->with('user', $user);
        } else {
            return redirect(route('user.home'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $username)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:100', 'regex:/^[A-Za-z0-9ñàèìòùÁÉÍÓÚ\s]+$/'],
            'name' => ['required', 'string', 'max:100', 'regex:/^[A-Za-zñàèìòùÁÉÍÓÚ\s]+$/'],
            'surname' => ['required', 'string', 'max:100', 'regex:/^[A-Za-zñàèìòùÁÉÍÓÚ\s]+$/'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        $user = User::where('username', $username)->first();
        if (isset($user)) {
            // si no hay un usuario con ese username o es el usuario autenticado el que tiene ese username...
            if ($this->checkUsername($request->username)) {
                $user->username = $request->username;
                $user->name = $request->name;
                $user->surname = $request->surname;
                $user->email = $request->email;
                if (isset($request->avatar)) {
                    $request->file('avatar')->storeAs('public/avatars', Auth::user()->id . '.' . $request->file('avatar')->getClientOriginalExtension());
                    $user->avatar = auth()->user()->id . '.' . $request->file('avatar')->getClientOriginalExtension();
                }

                $user->save();

                return redirect(route('user.show', ['username' => $user->username]));
            } else {
                return view('user.edit', ['user' => $user, 'username_error' => true]);
            }
        }
    }

    /**
     * Checks if the username already exists or if it's the currect user
     * 
     * @return boolean
     */
    public function checkUsername($username)
    {
        return sizeof(User::where('username', $username)->get()) == 0 || $username == Auth::user()->username;
    }

    public function makeRandomPassword()
    {
        // he quitado la l minúscula y la I mayúscula para evitar confusiones
        $characters = '0123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle(str_repeat($characters, 5)), 0, 8);
    }
}
