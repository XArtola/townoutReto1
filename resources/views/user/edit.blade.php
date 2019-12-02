@extends('layouts.main')
@section('title',$user->username)
@section('content')
<div id="content-container" class="row">
    <div class="avatar"><img src="{{asset('/assets/img/icons/person.svg')}}"/></div>
    <form action="{{route('user.update',['username'=>$user->username])}}" method="POST" class="column">
        @method('PUT')
        @csrf
        <div class="campo">
            <h5>Username</h5>
            <input type="text" name="username" value="{{$user->username}}">
        </div>
        <div class="campo">
            <h5>Nombre</h5>
            <input type="text" name="name" value="{{$user->name}}">
        </div>
        <div class="campo">
            <h5>Nombre</h5>
            <input type="text" name="name" value="{{$user->surname}}">
        </div>
        <div class="campo">
            <h5>Correo electrónico</h5>
            <input type="email" name="email" value="{{$user->email}}">
        </div>
        <input type="submit" name="submit" value="@lang('main.update')">
    </form>
</div>
@endsection
