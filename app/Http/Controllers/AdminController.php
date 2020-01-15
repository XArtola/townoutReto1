<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Mail;
use Illuminate\Support\Facades\URL;
use App\ContactMessage;

class AdminController extends Controller
{

    public function __construct()
    {

        $this->middleware(['auth', 'role:admin']);
    }

    public function admin()
    {
        $messagesActive = ContactMessage::where('active', 1)->get();
        $messagesNoActive = ContactMessage::where('active', 0)->get();
        $messages = $messagesActive->merge($messagesNoActive);
        return view('admin.admin', compact('messages'));
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
            'name' => ['required', 'string', 'max:100', 'regex:/^[A-Za-zñàèìòùÁÉÍÓÚ\s]+$/'],
            'surname' => ['required', 'string', 'max:100', 'regex:/^[A-Za-zñàèìòùÁÉÍÓÚ\s]+$/'],
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
        $user = User::find($id);
        return view('admin.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.edit',compact('user'));
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
        $request->validate([
            'username' => ['required', 'string', 'max:100', 'regex:/^[A-Za-z0-9ñàèìòùÁÉÍÓÚ\s]+$/'],
            'name' => ['required', 'string', 'max:100', 'regex:/^[A-Za-zñàèìòùÁÉÍÓÚ\s]+$/'],
            'surname' => ['required', 'string', 'max:100', 'regex:/^[A-Za-zñàèìòùÁÉÍÓÚ\s]+$/'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
       
        $user = User::where('id', $id)->first();
        if (isset($user)) {
            // si no hay un usuario con ese username o es el usuario autenticado el que tiene ese username...
            if ($this->checkUsername($request->username)) {
                $user->username = $request->username;
                $user->name = $request->name;
                $user->surname = $request->surname;
                $user->email = $request->email;
               /* if (isset($request->avatar)) {
                    $request->file('avatar')->storeAs('public/avatars', Auth::user()->id . '.' . $request->file('avatar')->getClientOriginalExtension());
                    $user->avatar = auth()->user()->id . '.' . $request->file('avatar')->getClientOriginalExtension();
                }*/

                $user->save();

                return redirect(route('admin.edit', ['id' => $user->id]));
            } else {
                return view('admin.edit', ['id' => $user->id, 'username_error' => true]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return $this->index();
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
