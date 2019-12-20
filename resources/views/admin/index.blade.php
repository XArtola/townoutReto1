@extends('layouts.main')
@section('title','Index')
@section('content')
<div class="column">
    <a href="{{route('admin.create')}}">Create</a>
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
                    <td><form action="{{route('user.destroy',['user'=>$user->id])}}" method="post">
                        @method('DELETE') 
                        @csrf
                        <input type="button" name="delete" value="delete">
                    </form></td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection

@section('js')
    $(document).ready(function(){
        $('table form input[type="button"]').click(function(){
            $(this).parent('form').submit();
        });
    });
@endsection