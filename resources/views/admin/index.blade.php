@extends('layouts.admin')
@section('title','Index')
@section('adminContent')
<div class="column">
    <h1 class="lead text-uppercase">Usuario registrados</h1>
    <div id="content-container" class="row">
        <table class="table text-center" id="usersTable">
            <tr>
                <th>Avatar</th>
                <th>Username</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th></th>
            </tr>
            @foreach($users as $user)
            <tr>
                <td>@if($user->avatar)<img src="{{$user->avatar}}" alt="Avatar">@endif</td>
                <td>{{$user->username}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->surname}}</td>
                <td>{{$user->email}}</td>
                <td>
                    <form action="{{route('admin.destroy',['user'=>$user->id])}}" method="post">
                        @method('DELETE')
                        @csrf
                        <input class="btn btn-dark" type="button" name="delete" value="delete">
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection

<script>
    $(document).ready(function () {
      
        console.log('entra')
        $('.active').removeClass('active');
        $('#usuarios').addClass('active')
});
  
</script>

@section('js')

$(document).ready(function(){
$('table form input[type="button"]').click(function(){
$(this).parent('form').submit();
});
});
@endsection