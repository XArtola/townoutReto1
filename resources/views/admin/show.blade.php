@extends('layouts.admin')
@section('title',$user->username)
@section('adminContent')
<h1 class="lead text-uppercase col-12">@lang('admin.personalInfo')</h1>
<div class="col-lg-6 col-sm-12 bg-white mx-auto mb-3" id="adminInfo">
    <div class="py-2">
        <h5 class="text-uppercase">@lang('admin.username')</h5>
        <hr class="bg-dark">
        <span class="pl-4">{{$user->username}}</span>
    </div>
    <div class="py-2">
        <h5 class="text-uppercase">@lang('admin.name')</h5>
        <hr class="bg-dark">
        <span class="pl-4">{{$user->name}}</span>
    </div>
    <div class="py-2">
        <h5 class="text-uppercase">@lang('admin.surname')</h5>
        <hr class="bg-dark">
        <span class="pl-4">{{$user->surname}}</span>
    </div>

    <div class="py-2">
        <h5 class="text-uppercase">@lang('admin.email')</h5>
        <hr class="bg-dark">
        <span class="pl-4">{{$user->email}}</span>
    </div>
    <div class="py-2 text-right">
        <a href="{{route('admin.edit',$user->id)}}" class="mr-3 btn btn-dark">@lang('main.edit')</a>
    </div>

</div>
@endsection