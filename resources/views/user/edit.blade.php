@extends('layouts.main')
@section('title',$user->username)
@section('content')
<div id="content-container" class="row">
    <div class="avatar"><img src="{{asset('/assets/img/icons/person.svg')}}"/></div>
    <form action="{{route('user.update')}}" method="put" class="column">
        <div class="campo">
            <h5>Username</h5>
            <input type="text" name="username">
        </div>
        <div class="campo">
            <h5>Nombre</h5>
            <input type="text" name="name">
        </div>
        <div class="campo">
            <h5>Correo electrónico</h5>
            <input type="email" name="email">
        </div>
    </form>
</div>
@endsection
