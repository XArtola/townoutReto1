@extends('layouts.main')
@section('title','Index')
@section('content')
<div id="content-container" class="row">
    <table>
        <tr>
            <th>Avatar</th>
            <th>Username</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td><img src="" alt="Avatar"></td>
                <td>{{$user->username}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->surname}}</td>
                <td>{{$user->email}}</td>
                <td><a href="{{route('user.destroy',['username'=>$user->username])}}">delete</a></td>
            </tr>
        @endforeach
    </table>
</div>
@endsection
