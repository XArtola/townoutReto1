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

    // Middleware para que las solo un usuario tipo admin pueda 
    // acceder a las vistas

    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }


    // Devuelve la vista admin con los mensajes ordenados
    // Primero los no leidos y luego los leidos

    public function admin()
    {
        $messagesActive = ContactMessage::where('active', 1)->get();
        $messagesNoActive = ContactMessage::where('active', 0)->get();
        $messages = $messagesActive->merge($messagesNoActive);
        return view('admin.admin', compact('messages'));
    }

    // Devuelve la vista index con lainformación
    // de todos los usuarios

    public function index()
    {
        return view('admin.index', ['users' => User::all()]);
    }

    // Devuelve la vista creación de usuario admin
    
    public function create()
    {
        return view('admin.create');
    }

    // Guarda en la base de datos un usuario admin

    public function store(Request $request)
    {

        //Validación de campos

        $request->validate([
            'username' => ['required', 'string', 'max:100', 'unique:users', 'regex:/^[A-Za-z0-9ñàèìòùÁÉÍÓÚ\s]+$/'],
            'name' => ['required', 'string', 'max:100', 'regex:/^[A-Za-zñàèìòùÁÉÍÓÚ\s]+$/'],
            'surname' => ['required', 'string', 'max:100', 'regex:/^[A-Za-zñàèìòùÁÉÍÓÚ\s]+$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        //Inserción de datos y guardaddo

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

    // Muestra la información de usuario admin

    public function show($id)
    {
        if (Auth()->user()->id == $id) {
            $user = User::find($id);
            return view('admin.show', compact('user'));
        } else
            return redirect()->route('admin.admin');
    }

    // Devuelve la vista de edición de usuario 
    // tomando el identificador del usuario a editar

    public function edit($id)
    {
        if (Auth()->user()->id == $id) {
            $user = User::find($id);
            return view('admin.edit', compact('user'));
        } else
            return redirect()->route('admin.admin');
    }

    // Actualiza la información de usuario

    public function update(Request $request, $id)
    {
        // valida los campos
        $request->validate([
            'username' => ['required', 'string', 'max:100', 'regex:/^[A-Za-z0-9ñàèìòùÁÉÍÓÚ\s]+$/'],
            'name' => ['required', 'string', 'max:100', 'regex:/^[A-Za-zñàèìòùÁÉÍÓÚ\s]+$/'],
            'surname' => ['required', 'string', 'max:100', 'regex:/^[A-Za-zñàèìòùÁÉÍÓÚ\s]+$/'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        // Coge usuario
        $user = User::where('id', $id)->first();
        if (isset($user)) {
            // si no hay un usuario con ese username o es el usuario autenticado el que tiene ese username...
            if ($this->checkUsername($request->username)) {
                $user->username = $request->username;
                $user->name = $request->name;
                $user->surname = $request->surname;
                $user->email = $request->email;

                $user->save();

                return redirect(route('admin.edit', ['id' => $user->id]));
            } else {
                return view('admin.edit', ['id' => $user->id, 'username_error' => true]);
            }
        }
    }

    // Elimina un usuario

    public function destroy($id)
    {
        User::find($id)->delete();
        return $this->index();
    }

    //Comprueba si un nombre de usuario existe

    public function checkUsername($username)
    {
        return sizeof(User::where('username', $username)->get()) == 0 || $username == Auth::user()->username;
    }

    //Genera una contraseña aleatoria

    public function makeRandomPassword()
    {
        // he quitado la l minúscula y la I mayúscula para evitar confusiones
        $characters = '0123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle(str_repeat($characters, 5)), 0, 8);
    }

    public function getStadistics()
    {
        return view('admin.stadistics');
    }
}
