@extends('layouts.user')
@section('title',$user->username)
@section('content')
<div id="content-container" class="row">
    <div class="row col-lg-7 col-sm-12">
        <div class="col-6">
            @if($user->is_admin)
            <h6 class="text-center font-weight-bold mt-3">ADMIN</h6>
            @endif
            <div class="avatar">
                @isset($user->avatar)
                <img id="avatar" src="{{route('storage','avatars/'.$user->avatar)}}" />
                @else
                <img id="avatar" src="{{asset('/assets/img/icons/person.svg')}}" />
                @endisset
            </div>
        </div>
        <div class="col-6">
            <div class="campo">
                <h5>@lang('user.username')</h5>
                <span>{{$user->username}}</span>
            </div>
            <div class="campo">
                <h5>@lang('user.name')</h5>
                <span>{{$user->name}}</span>
            </div>
            <div class="campo">
                <h5>@lang('user.surname')</h5>
                <span>{{$user->surname}}</span>
            </div>
            @if($user->username == Auth::user()->username)
            <div class="campo">
                <h5>@lang('user.email')</h5>
                <span>{{$user->email}}</span>
            </div>
            <a href="{{route('user.edit',auth()->user()->username)}}" class="mr-3 btn btn-secondary">@lang('main.edit')</a>
           
            @endif
        </div>

       
    </div>
    <div class="col-lg-5 col-sm-12">
        <h3 class="text-center">@lang('user.resume')</h3>
        <table class="table text-center">
            <thead>
                <th>@lang('user.created_circuits')</th>
                <th>@lang('user.played_circuits')</th>
            </thead>
            <tr>
                <td>{{$user->circuits->count()}}</td>
                <td>{{$user->games->count()}}</td>
            </tr>
        </table>
    </div>
</div>
@endsection