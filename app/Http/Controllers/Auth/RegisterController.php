<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Mail;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/verify';
    //Para redireccionar dependiendo del resultado del registro
    /*
    protected function redirectTo()
    {
        //You would need to modify this according to your needs, this is just an example.
        if (Auth::user()->hasRole('admin')) {
            return 'path';
        }

        if (Auth::user()->hasRole('regular_user')) {
            return 'path';
        }

        return 'default_path';
    }
*/
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            //He añadido validación de nombre de usuario
            'username' => ['required', 'string', 'max:100', 'unique:users'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'name' => $data['name'],
            'surname'=>$data['surname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'hasAvatar'=>false,
        ]);

        // Mandar correo de confirmación
        Mail::send('emails.confirmation_code', $data, function ($message) use ($data) {
            $message->to($data['email'], $data['name'])->subject('Por favor confirma tu correo');
        });

        return redirect(route('verify'));
    }
    /*Con esto evitamos auto login al registrar un user*/
    public function register(RegisterRequest $request)
    {
        /*Validación de los campos registro*/

        event(new Registered($user = $this->create($request->all())));
        // User::where('email', $request->email)->update(['confirmation_code' => Str::random(30)]);
        // $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    /*
    protected function guard()
    {
        return Auth::guard('guard-name');
    }*/


    public function verifyUser($username)
    {
        $user = User::where('username', $username)->first();

        if (!$user)
            return redirect('/');

        $user->confirmed = true;
        $user->confirmationCode = null;
        $user->email_verified_at= now()->timestamp;
        $user->save();

        return redirect('/')->with('notification', '¡¡Ya puedes iniciar sesión, empieza a descubrir el mundo!!');
    }
}
