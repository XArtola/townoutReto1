<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Mail;
use Illuminate\Support\Facades\URL;

class AdminController extends Controller
{

    public function __construct(){

        $this->middleware(['auth', 'role:admin']);
    
    }

    public function admin(){

        return view('admin.admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index', ['users' => User::all()]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
                $user->role = "admin";
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
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

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
