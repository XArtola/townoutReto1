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
        </div>
        <input type="file" id="image" name="avatar">
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
                <h5>@lang('user.name')</h5>
                <input type="text" name="name" value="{{$user->name}}">
                <label class="error" for="name"></label>
            </div>
            <div class="campo edit">
                <h5>@lang('user.surname')</h5>
                <input type="text" name="surname" value="{{$user->surname}}">
                <label class="error" for="surname"></label>
            </div>
            <div class="campo edit">
                <h5>@lang('user.email')</h5>
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
            console.log($('form input#image').val())
            console.log($('input#image').val().match(/[A-Za-z0-9]+\.[A-Za-z0-9]+/)[0])
            $('.avatar').empty();
            $('.avatar').html(`<img id='avatar' src=`+window.URL.createObjectURL(document.getElementById('file').files[0])+`/>`);
        });
    });
@endsection