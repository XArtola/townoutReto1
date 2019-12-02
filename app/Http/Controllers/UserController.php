<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        if(Auth::user()->is_admin)
            return view('user.index',['users'=>User::all()]);
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($username)
    {
        return view('user.show')->with('user',User::where('username',$username)->first());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($username)
    {
        $user = User::where('username',$username)->first();
        if(Auth::user()->username == $user->username){
            return view('user.edit')->with('user',$user);
        }else{
            return redirect(route('user.show',['username'=>$username]));
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
        $user = User::where('username',$username)->first();
        if(isset($user)){
            // si no hay un usuario con ese username o es el usuario autenticado el que tiene ese username...
            if(sizeof(User::where('username',$request->username)->get()) == 0 || $request->username == Auth::user()->username){
                $user->username = $request->username;
                $user->name = $request->name;
                $user->surname = $request->surname;
                $user->email = $request->email;

                if(isset($request->image)){
                    $request->file('image')->storeAs('avatar', Auth::user()->id.$request->file('image')->getClientOriginalExtension());
                    $user->hasAvatar = true;
                }
                
                $user->save();

                return redirect(route('user.show',['username'=>$user->username]));
            }else{
                return view('user.edit',['user'=>$user,'username_error'=>true]);
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
        //
    }
}
