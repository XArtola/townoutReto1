@extends('layouts.user')
@section('title',$user->username)
@section('content')
<div class="row py-auto my-auto d-flex align-items-center justify-content-center">
    <div class="row col-lg-7 col-sm-12 align-self-center">
        <div class="col-6 justify-content-center my-4">
            <div class="avatar mx-auto">
                @isset($user->avatar)
                <img id="avatar" class="rounded-circle" src="{{$user->avatar}}" />
                @else
                <img id="avatar" src="{{asset('/assets/img/icons/person.svg')}}" />
                @endisset
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-12 align-self-center">
            <div class="my-auto">
                <div class="my-3 mx-1 pb-2">
                    <h5 class="font-weight-bold text-uppercase text-left userField border-bottom border-dark">@lang('user.username')</h5>
                    <h4 class="text-center mx-auto">{{$user->username}}</h4>
                </div>
                <div class="my-3 mx-1 pb-2">
                    <h5 class="font-weight-bold text-uppercase text-left userField border-bottom border-dark">@lang('user.name')</h5>
                    <h4 class="text-center mx-auto">{{$user->name}}</h4>
                </div>
                <div class="my-3 mx-1 pb-2">
                    <h5 class="font-weight-bold text-uppercase text-left userField border-bottom border-dark">@lang('user.surname')</h5>
                    <h4 class="text-center mx-auto">{{$user->surname}}</h4>
                </div>
                @if($user->username == Auth::user()->username)
                <div class="my-3 mx-1 pb-2">
                    <h5 class="font-weight-bold text-uppercase text-left userField border-bottom border-dark">@lang('user.email')</h5>
                    <h4 class="text-center mx-auto">{{$user->email}}</h4>
                </div>
                <div class="mx-auto">
                    <a href="{{route('user.edit',auth()->user()->username)}}" class="btn btn-primary">@lang('main.edit')</a>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-lg-5 col-sm-12 align-self-center py-3">
        <table class="table text-center">
            <thead class="thead-dark">
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