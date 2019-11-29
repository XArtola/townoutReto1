@extends('layouts.main')
@section('title',$user->username)
@section('content')
<div id="content-container" class="row">
    <div class="avatar"><img src="{{asset('/assets/img/icons/person.svg')}}"/></div>
    <div class="column">
        <div class="campo">
            <h5>Username</h5>
            <span>{{$user->username}}</span>
        </div>
        <div class="campo">
            <h5>Nombre</h5>
            <span>{{$user->name}}</span>
        </div>
        <div class="campo">
            <h5>Correo electrónico</h5>
            <span>{{$user->email}}</span>
        </div>
    </div>
</div>
@endsection
