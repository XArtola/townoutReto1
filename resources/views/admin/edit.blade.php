@extends('layouts.admin')
@section('title',$user->username)
@section('adminContent')
<h1 class="lead text-uppercase col-12">@lang('admin.editInfo')</h1>

<div class="col-lg-6 col-sm-12 mx-auto mb-4 py-2" id="editAdminForm">
    <form action="{{route('admin.update',['id'=>$user->id])}}" id="edit_form" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        <div class="form-group">
            <h5>@lang('admin.username')</h5>
            <input type="text" name="username" value="{{$user->username}}" class="form-control">
            <label class="error" for="username"></label>
            @isset($username_error)
            <span class="error">@lang('main.username_error')</span>
            @endisset
        </div>

        <div class="form-group">
            <h5>@lang('admin.name')</h5>
            <input type="text" name="name" value="{{$user->name}}" class="form-control">
            <label class="error" for="name"></label>
        </div>

        <div class="form-group">
            <h5>@lang('admin.surname')</h5>
            <input type="text" name="surname" value="{{$user->surname}}" class="form-control">
            <label class="error" for="surname"></label>
        </div>

        <div class="form-group">
            <h5>@lang('admin.email')</h5>
            <input type="email" name="email" value="{{$user->email}}" class="form-control">
            <label class="error" for="email"></label>
        </div>

        <div class="py-2 text-right">
            <input type="button" id="submit_edit" value="@lang('main.update')" class="btn btn-dark">
        </div>
</div>
@if($errors->any())
<div id="errors">
    @foreach($errors->all() as $error)
    <span class="error">{{$error}}</span>
    @endforeach
    @endif

    </form>
</div>
@endsection