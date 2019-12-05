@extends('layouts.main')
@section('title',$user->username)
@section('content')
<div id="content-container">
    <form action="{{route('user.update',['username'=>$user->username])}}" id="edit_form" method="POST" class="row" enctype="multipart/form-data">
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
            <div class="campo">
                <h5>Username</h5>
                <input type="text" name="username" value="{{$user->username}}">
                <label class="error" for="username"></label>
                @isset($username_error) 
                    <span class="error">@lang('main.username_error')</span>
                @endisset
            </div>
            <div class="campo">
                <h5>Nombre</h5>
                <input type="text" name="name" value="{{$user->name}}">
                <label class="error" for="name"></label>
            </div>
            <div class="campo">
                <h5>Apellido</h5>
                <input type="text" name="surname" value="{{$user->surname}}">
                <label class="error" for="surname"></label>
            </div>
            <div class="campo">
                <h5>Correo electrónico</h5>
                <input type="email" name="email" value="{{$user->email}}">
                <label class="error" for="email"></label>
            </div>
            <input type="button" id="submit_edit" value="@lang('main.update')">
        </div>
        @if($errors->any())
        <div id="errors">
            @foreach($errors->all() as $error)
                <span class="error">{{$error}}</span>
            @endforeach
        @endif
        </div>
    </form>
</div>
@endsection
