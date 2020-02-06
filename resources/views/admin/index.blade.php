@extends('layouts.admin')
@section('title') @lang('admin.users') @endsection
@section('adminContent')
<div class="column">
    <h1 class="lead text-uppercase">@lang('admin.registeredUsers')</h1>
    <div id="content-container" class="row">
        <table class="table text-center table-responsive-sm" id="usersTable">
            <tr>
                <th>@lang('admin.username')</th>
                <th>@lang('admin.name')</th>
                <th>@lang('admin.surname')</th>
                <th>@lang('admin.email')</th>
                <th></th>
            </tr>
            @foreach($users as $user)
            <tr>
                <td>{{$user->username}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->surname}}</td>
                <td>{{$user->email}}</td>
                <td>
                    <form action="{{route('admin.destroy',['user'=>$user->id])}}" method="post">
                        @method('DELETE')
                        @csrf
                        <input class="btn btn-dark" type="submit" name="delete" value="@lang('admin.delete')">
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection

@section('js')
    // Al hacer click sobre el boton enviar 
    // hacer un submit
    $(document).ready(function() {
        $('table form input[type="button"]').click(function() {
            $(this).parent('form').submit();
        });
    });
@endsection