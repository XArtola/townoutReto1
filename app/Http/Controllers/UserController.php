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
    // Da acceso solamente a ususarios autenticados y con rol usuario
    // (admin no podran visualizar estas vistas)
    public function __construct()
    {
        $this->middleware(['auth', 'role:user']);
    }

    // Devuelve vista home 
    public function home()
    {
        $circuits = Circuit::where('lang', app()->getLocale())->get();
        return view('user.home')->with('user', User::where('username', auth()->user()->username)->first())->with(compact('circuits'));
    }

    //Devuelve vista de infomación de juego
    public function info()
    {
        return view('user.info');
    }

    // Devuelve vista con información del usuario 
    // recogiendo nombre de usuario
    public function show($username)
    {
        //Sustituir en un futuro por policies
        if ($username === Auth()->user()->username)
            return view('user.show')->with('user', User::where('username', $username)->first());
        else
            return redirect()->route('user.home');
    }

    // Devuelve vista de edición de usuario
    public function edit($username)
    {
        $user = User::where('username', $username)->first();
        if (Auth::user()->username == $user->username) {
            return view('user.edit')->with('user', $user);
        } else {
            return redirect(route('user.home'));
        }
    }

    // Actualiza la información de usuario

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
                /*
                if (isset($request->avatar)) {
                    $request->file('avatar')->storeAs('public/avatars', Auth::user()->id . '.' . $request->file('avatar')->getClientOriginalExtension());
                    $user->avatar = auth()->user()->id . '.' . $request->file('avatar')->getClientOriginalExtension();
                }
*/
                if (isset($request->avatar)) {
                    $file = $request->file('avatar');

                    $client = new \GuzzleHttp\Client();

                    $response = $client->request('POST', 'https://api.imgur.com/3/image', [
                        'headers' => [
                            'authorization' => 'Bearer b9ef1e8c0d7dd3fa4f4ea534a6f6856eaea692e8',
                            'content-type' => 'application/x-www-form-urlencoded',
                        ], 'form_params' => [
                            'image' => base64_encode(file_get_contents($request->file('avatar')->path())),

                        ],
                    ]);

                    $user->avatar = json_decode(($response->getBody()->getContents()), true)['data']['link'];
                }

                $user->save();

                return redirect(route('user.show', ['username' => $user->username]));
            } else {
                return view('user.edit', ['user' => $user, 'username_error' => true]);
            }
        }
    }


    //Comprueba si el nombre de usuario existe

    public function checkUsername($username)
    {
        return sizeof(User::where('username', $username)->get()) == 0 || $username == Auth::user()->username;
    }
}
