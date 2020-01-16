@extends('layouts.user')
@section('title','Creación')
@section('content')
<div id="content-container">
    <form action="{{route('user.store')}}" method="POST" id="create_form" class="row" enctype="multipart/form-data">
        @csrf
        <div class="column">
            <div class="campo">
                <h5>Username</h5>
                <input type="text" name="username">
                <label class="error" for="username"></label>
                @isset($username_error) 
                    <span class="error">@lang('main.username_error')</span>
                @endisset
            </div>
            <div class="campo">
                <h5>@lang('user.name')</h5>
                <input type="text" name="name">
                <label class="error" for="name"></label>
            </div>
            <div class="campo">
                <h5>@lang('user.surname')</h5>
                <input type="text" name="surname">
                <label class="error" for="surname"></label>
            </div>
            <div class="campo">
                <h5>@lang('user.email')</h5>
                <input type="email" name="email">
                <label class="error" for="email"></label>
            </div>
            <input type="button" id="submit_create" value="Enviar">
        </div>
    </form>
    @if($errors->any())
        <div id="errors">
            @foreach($errors as $error)
                <span class="error">{{$error}}</span>
            @endforeach
        </div>
    @endif
</div>
@endsection
