<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/admin';
    public function redirectTo(){
        
        // User role
        $role = Auth::user()->role; 
        
        // Check user role
        switch ($role) {
            case 'admin':
                    return '/admin';
                break;
            case 'user':
                    return '/home';
                break; 
            default:
                    return '/'; 
                break;
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware(['auth', 'verified']);
        $this->middleware('guest')->except('logout');
    }
    /*Control de usuario verificado al iniciar sesión*/
    public function authenticated(Request $request, $user)
    {
        if (!$user->hasVerifiedEmail()) {
            auth()->logout();
            return back()->with('warning', 'You need to confirm your account. 
            We have sent you an activation code, please check your email.');
        }
        return redirect()->intended($this->redirectPath());
    }
    /*Hacer aqui validación personalizada */
    /*
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->email() => 'required',
            'password' => 'required',
            // new rules here
        ]);
    }
    */
}
