<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mail;
use Illuminate\Support\Facades\URL;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->is_admin)
            return view('user.index', ['users' => User::all()]);
        else
            return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->is_admin) return view('user.create');
        else return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->is_admin) {

            $request->validate([
                'username' => ['required', 'string', 'max:100', 'unique:users', 'regex:/^[A-Za-z0-9ñàèìòùÁÉÍÓÚ\s]+$/'],
                'name' => ['required', 'string', 'max:100','regex:/^[A-Za-zñàèìòùÁÉÍÓÚ\s]+$/'],
                'surname' => ['required', 'string', 'max:100','regex:/^[A-Za-zñàèìòùÁÉÍÓÚ\s]+$/'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);

            if ($this->checkUsername($request->username)) {
                $user = new User;
                $user->username = $request->username;
                $user->name = $request->name;
                $user->surname = $request->surname;
                $user->email = $request->email;
                $user->is_admin = true;
                $randomPassword = $this->makeRandomPassword();
                $user->password =  Hash::make($randomPassword);
                $user->save();

                $url = URL::signedRoute('activate', ['username' => $user->username]);
                $data = ['username' => $user->username, 'randomPassword' => $randomPassword, 'url' => $url];
                Mail::send('emails.randomPassword', $data, function ($message) use ($user) {
                    $message->to($user->email, $user->username)->subject('Se le ha concedido acceso a la administración de TownOut');
                });
                return redirect('/index');
            } else
                return view('user.create', ['username_error' => true]);
        } else return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($username)
    {
        return view('user.show')->with('user', User::where('username', $username)->first());
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
            return redirect(route('user.show', ['username' => $username]));
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
            'name' => ['required', 'string', 'max:100','regex:/^[A-Za-zñàèìòùÁÉÍÓÚ\s]+$/'],
            'surname' => ['required', 'string', 'max:100','regex:/^[A-Za-zñàèìòùÁÉÍÓÚ\s]+$/'],
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

                if (isset($request->image)) {
                    $request->file('image')->storeAs('public/avatars',Auth::user()->id .'.'. $request->file('image')->getClientOriginalExtension());
                    $user->avatar = Auth::user()->id .'.'. $request->file('image')->getClientOriginalExtension();
                }

                $user->save();

                return redirect(route('user.show', ['username' => $user->username]));
            } else {
                return view('user.edit', ['user' => $user, 'username_error' => true]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (Auth::user()->is_admin) {
            $user->delete();
            return $this->index();
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
