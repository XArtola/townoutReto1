@extends('layouts.admin')
@section('title',$user->username)
@section('adminContent')
<h1 class="lead text-uppercase col-12">Información de usuario</h1>
<div class="col-6 bg-white mx-auto" id="adminInfo">
    <div class="py-2">
        <h5 class="text-uppercase">Username</h5>
        <hr class="bg-dark">
        <span class="pl-4">{{$user->username}}</span>
    </div>
    <div class="py-2">
        <h5 class="text-uppercase">Nombre</h5>
        <hr class="bg-dark">
        <span class="pl-4">{{$user->name}}</span>
    </div>
    <div class="py-2">
        <h5 class="text-uppercase">Apellido</h5>
        <hr class="bg-dark">
        <span class="pl-4">{{$user->surname}}</span>
    </div>

    <div class="py-2">
        <h5 class="text-uppercase">Correo electrónico</h5>
        <hr class="bg-dark">
        <span class="pl-4">{{$user->email}}</span>
    </div>
    <div class="py-2 text-right">
        <a href="{{route('admin.edit',$user->id)}}" class="mr-3 btn btn-dark">@lang('main.edit')</a>
    </div>


</div>
@endsection