@extends('layouts.user')
@section('content')

<div class="col-lg-11 col-sm-12">

    <table class="table my-2 text-center mx-auto">
        <tr>
            <th>Circuito</th>
            <th>Fecha</th>
            <th></th>
        </tr>
        @foreach($games as $game)
        @if($game->user_id === Auth::user()->id)
        <tr>
            <td>{{$game->circuit->name}}</td>
            <td>{{$game->start_date}}</td>
            <td><a style="text-decoration: none; background-color:transparent" href="{{route('games.show',$game->id)}}"><i class="fas fa-info-circle fa-2x" style="color:black"></i></a></td>
        </tr>
        @endif
        @endforeach
    </table>
</div>

@endsection