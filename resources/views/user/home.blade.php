@extends('layouts.user')
@section('title','Index')
@section('content')
<div id="all_circuits" class="p-1">

	<div class="row bg-warning my-4">
		<h1 class="text-light text-uppercase lead col-12 font-weight-bold p-2 mx-4">Circuitos disponibles</h1>

		@foreach($circuits as $circuit)
		@if($circuit->caretaker == 0)
		<div class="card my-2 mx-4" style="width: 18rem;">
			@isset($circuit->image)
			<img src="{{$circuit->image}}" class="card-img-top" alt="">
			@else
			<img src="{{asset('assets/img/logoPNG.png')}}" class="card-img-top p-1" alt="">
			@endisset
			<div class="card-body">
				<h5 class="card-title text-uppercase font-weight-bold">{{$circuit->name}}</h5>
				<p class="card-text pl-4"><i class="fas fa-lg fa-globe-europe"></i> {{$circuit->city}}</p>
				<p class="card-text pl-4"><i class="fas fa-lg fa-stopwatch"></i> {{$circuit->duration}}</p>
				<div class="text-center">
					<a href="{{route('games.newGame',$circuit->id)}}"><button class="btn btn-primary">Jugar</button></a>
				</div>
			</div>
		</div>
		@endif
		@endforeach
	</div>
</div>
<div id="my_circuits" class="p-1">

	<div class="row bg-info my-4">
		<h1 class="text-light text-uppercase lead col-12 font-weight-bold p-2 mx-4">Mis circuitos</h1>

		@foreach($circuits as $circuit)
		@if(Auth::user()->id==$circuit->user->id)
		<div class="card my-2 mx-4" style="width: 18rem;">
			@isset($circuit->image)
			<img src="{{$circuit->image}}" class="card-img-top" alt="">
			@else
			<img src="{{asset('assets/img/logoPNG.png')}}" class="card-img-top p-1" alt="">
			@endisset
			<div class="card-body">
				<h5 class="card-title text-uppercase font-weight-bold">{{$circuit->name}}</h5>
				<p class="card-text pl-4"><i class="fas fa-lg fa-globe-europe"></i> {{$circuit->city}}</p>
				<p class="card-text pl-4"><i class="fas fa-lg fa-stopwatch"></i> {{$circuit->duration}}</p>
				@if($circuit->caretaker == 1)
				<p class="card-text pl-4"><i class="fas fa-lg fa-eye"></i> Circuito caretaker</p>
				<div class="text-center">
					<a href=""><button class="btn btn-primary">Guiar partida</button></a>
				</div>
				@endif
				<div class="text-center">
					<a href=""><button class="btn btn-primary">Info</button></a>
				</div>
			</div>
		</div>
		@endif
		@endforeach
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