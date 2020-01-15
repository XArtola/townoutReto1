@extends('layouts.user')
@section('title','Index')
@section('content')
<div id="all_circuits" class="circuit-container">

	<h1 class="display-4 text-uppercase lead col-12 p-2 mx-4">Circuitos disponibles</h1>
	<div id="circuits">

		@foreach($circuits as $circuit)
		@if($circuit->caretaker == 0)
		<div class="card my-2 mx-4" style="width: 18rem;">
			<div class="card-header">
				<div class="card-image">
					@isset($circuit->image)
						<img src="{{asset('/storage/circuits/'.$circuit->image)}}" class="card-img-top" alt="">
					@else
						<img src="{{asset('assets/img/compressed-logo.svg')}}" class="card-img-top default" alt="">
					@endisset
				</div>
			</div>
			<div class="card-body">
				<h5 class="card-title text-uppercase font-weight-bold">{{$circuit->name}}</h5>
				<p class="card-text"><i class="fas fa-lg fa-globe-europe"></i> {{$circuit->city}}</p>
				<p class="card-text"><i class="fas fa-lg fa-stopwatch"></i> {{$circuit->duration}}</p>
				<div class="text-center">
					<a href="{{route('games.newGame',$circuit->id)}}" class="btn btn-primary">Jugar</a>
				</div>
			</div>
		</div>
		@endif
		@endforeach
	</div>
</div>
<div id="my_circuits" class="circuit-container">

	<h1 class="display-4 text-uppercase lead col-12">Mis circuitos</h1>
	<div>
		@foreach($circuits as $circuit)
		@if(Auth::user()->id==$circuit->user->id)
		<div class="card">
			<div class="card-header">
				<div class="card-image">
					@isset($circuit->image)
						<img src="{{asset('/storage/circuits/'.$circuit->image)}}" class="card-img-top" alt="">
					@else
						<img src="{{asset('assets/img/compressed-logo.svg')}}" class="card-img-top default" alt="">
					@endisset
				</div>
			</div>
			<div class="card-body">
				<h5 class="card-title text-uppercase font-weight-bold">{{$circuit->name}}</h5>
				<p class="card-text"><i class="fas fa-lg fa-globe-europe"></i> {{$circuit->city}}</p>
				<p class="card-text"><i class="fas fa-lg fa-stopwatch"></i> {{$circuit->duration}}</p>
				@if($circuit->caretaker == 1)
				<p class="card-text"><i class="fas fa-lg fa-eye"></i> Circuito caretaker</p>
				<div class="text-center">
					<a href=""><button class="btn btn-primary">Guiar partida</button></a>
				</div>
				@endif
				<div class="text-center">
					<a href="" class="btn btn-primary">Info</a>
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
		$('.card').click(function(){
			window.location.href = $(this).find('a.btn').attr('href');
		});
	});
@endsection