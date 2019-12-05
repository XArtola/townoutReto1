@extends('layouts.main')
@section('title',$user->username)
@section('content')
<div id="content-container">
    <form action="{{route('user.update',['username'=>$user->username])}}" method="POST" class="row" enctype="multipart/form-data" id="edit_form">
        @method('PUT')
        @csrf
        
        <div class="avatar">
        @if($user->hasAvatar)
            <img id="avatar" src="{{asset('/users/avatars/').$user->id.'.jpg'}}"/>
        @else
            <img id="avatar" src="{{asset('/assets/img/icons/person.svg')}}"/>
        @endif
        
        <input type="file" id="image" name="image">

        </div>
        <div class="column">
            <div class="campo edit">
                <h5>Username</h5>
                <input type="text" name="username" value="{{$user->username}}">
                <span class="error" data-for="edit_username"></span>
                @isset($username_error) 
                    <span class="error">@lang('main.username_error')</span>
                @endisset
            </div>
            <div class="campo edit">
                <h5>Nombre</h5>
                <input type="text" name="name" value="{{$user->name}}">
                <span class="error" data-for="edit_name"></span>
            </div>
            <div class="campo edit">
                <h5>Apellido</h5>
                <input type="text" name="surname" value="{{$user->surname}}">
                <span class="error" data-for="edit_surname"></span>
            </div>
            <div class="campo edit">
                <h5>Correo electrónico</h5>
                <input type="email" name="email" value="{{$user->email}}">
                <span class="error" data-for="edit_email"></span>
            </div>
            <input id="edit_send" type="button" name="submit" value="@lang('main.update')">
        </div>
    </form>
</div>
@endsection
