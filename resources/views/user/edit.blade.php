@extends('layouts.user')
@section('title',$user->username)
@section('content')
<div id="content-container">
    <form action="{{route('user.update',['username'=>$user->username])}}" id="edit_form" method="POST" class="row" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        
        <div class="avatar">
        @isset($user->avatar)
            <img id="avatar" src="{{route('storage','avatars/'.$user->avatar)}}"/>
        @else
            <img id="avatar" src="{{asset('/assets/img/icons/person.svg')}}"/>
        @endisset
        
        <input type="file" id="image" name="image">

        </div>
        <div class="column">
            <div class="campo edit">
                <h5>Username</h5>
                <input type="text" name="username" value="{{$user->username}}">
                <label class="error" for="username"></label>
                @isset($username_error) 
                    <span class="error">@lang('main.username_error')</span>
                @endisset
            </div>
            <div class="campo edit">
                <h5>Nombre</h5>
                <input type="text" name="name" value="{{$user->name}}">
                <label class="error" for="name"></label>
            </div>
            <div class="campo edit">
                <h5>Apellido</h5>
                <input type="text" name="surname" value="{{$user->surname}}">
                <label class="error" for="surname"></label>
            </div>
            <div class="campo edit">
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
@section('js')
    $(document).ready(function(){

        $('input#image').change(function(){
            console.log($('input#image').val().match(/[A-Za-z0-9]+\.[A-Za-z0-9]+/)[0])
            $('.avatar').empty();
            $('.avatar').html(`<img id='avatar' src='{{url('storage','avatars')}}/`+ $('input#image').val().match(/[A-Za-z0-9]+\.[A-Za-z0-9]+/)[0] +`'/>`);
        });
    });
@endsection