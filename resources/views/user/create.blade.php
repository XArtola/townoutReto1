@extends('layouts.main')
@section('title','Creación')
@section('content')
<div id="content-container">
    <form action="{{route('user.store')}}" method="POST" class="row" enctype="multipart/form-data">
        @csrf
        <div class="column">
            <div class="campo">
                <h5>Username</h5>
                <input type="text" name="username">
                @isset($username_error) 
                    <span class="error">@lang('main.username_error')</span>
                @endisset
            </div>
            <div class="campo">
                <h5>Nombre</h5>
                <input type="text" name="name">
            </div>
            <div class="campo">
                <h5>Apellido</h5>
                <input type="text" name="surname">
            </div>
            <div class="campo">
                <h5>Correo electrónico</h5>
                <input type="email" name="email">
            </div>
            <input type="submit" name="submit" value="Enviar">
        </div>
    </form>
</div>
@endsection
