@extends('layouts.user')
@section('content')
<div id="stages">

	@php
		$counter = 0;
	@endphp

	@foreach($circuit->stages as $stage)

		<div id="stage_{{$stage->id}}" class="stage">
			<h1 class="display-4">{{$counter++}} @lang('circuits.stage')</h1>
		</div>

	@endforeach
	
	@foreach($games as $game)
		<div class="player" data-game="{{$game->id}}">
			{{$game->user->username}}
		</div>
	@endforeach
	
</div>
<script>
	$(function() {
		setInterval(function() {

			$('.player').each(function(){

				$.ajax({
					url: base_url+'api/games/' + $(this).attr('data-game') + '/get',
					crossDomain: true,
					success: function(response) {
						console.dir(response.data);
					},
					error: function(request, status, error) {
						console.log('Error. No se ha podido obtener la información del juego: ' + request.responseText + " | " + error);
					},
				});

				/*
				$.ajax({
					url: base_url+'api/locations/' + $(this).attr('data-game') + '/lastLocation',
					crossDomain: true,
					success: function(response) {
						console.dir(response.data);
					},
					error: function(request, status, error) {
						console.log('Error. No se ha podido obtener la información del juego: ' + request.responseText + " | " + error);
					},
				});
				*/

			});

		}, 5000);

	});
</script>
@endsection