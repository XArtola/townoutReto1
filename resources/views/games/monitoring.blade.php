@extends('layouts.user')
@section('imports')
	<link rel="stylesheet" type="text/css" href="{{secure_asset('/assets/css/game.css')}}">
@endsection
@section('content')
<div id="stages">

	@php
		$phase = 0;
	@endphp

	@foreach($circuit->stages as $stage)
		<div id="stage_{{$stage->id}}" class="stage">
			<h1 class="display-4">{{$phase + 1}} @lang('circuits.stage')</h1>
		</div>
		@php $phase++ @endphp

	@endforeach
	
	@foreach($games as $game)
		<div class="player" data-game="{{$game->id}}">
			{{strtoupper(substr($game->user->username,0,1))}}
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
						console.log(response.data)
						console.log($('#stage_'+response.data.phase))
						$(this).animate({'top':$('#stage_'+response.data.phase).offset().top})
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