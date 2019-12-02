@extends('layouts.main')
@section('title',$user->username)
@section('content')
<div id="content-container" class="row">
    <div class="column mr-5">
        @if($user->is_admin)
            <h6 class="text-center font-weight-bold mt-3">ADMIN</h6>
        @endif
        <div class="avatar">
            @if($user->hasAvatar)
                <img id="avatar" src="{{asset('/users/avatars/').$user->id.'.jpg'}}"/>
            @else
                <img id="avatar" src="{{asset('/assets/img/icons/person.svg')}}"/>
            @endif
        </div>
    </div>
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
            <h5>Apellido</h5>
            <span>{{$user->surname}}</span>
        </div>
        @if($user->username == Auth::user()->username)
        <div class="campo">
            <h5>Correo electrónico</h5>
            <span>{{$user->email}}</span>
        </div>
        <a href="{{route('user.edit',['username'=>Auth::user()->username])}}">@lang('main.edit')</a>
        @endif
    </div>
</div>
@endsection
