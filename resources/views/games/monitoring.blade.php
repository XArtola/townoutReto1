@extends('layouts.user')
@section('imports')
	<link rel="stylesheet" type="text/css" href="{{secure_asset('/assets/css/game.css')}}">
@endsection
@section('content')
<div id="stages">
		<div id="player-start"></div>
	@php
		$phase = 0;
	@endphp

	@foreach($circuit->stages as $stage)
		<div id="stage_{{$phase}}" class="stage">
			<h1 class="display-4">{{$phase + 1}} @lang('circuits.stage')</h1>
			<h5>{{$stage->question_text}}</h5>
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

		for(let i = 0; i < $('.player').length; i++){
			if(i === 0)
				$('.player')[i].css.right = 40 + 'px';
			else
				$('.player')[i].css.right = i*(90 + 20) + 'px'; // los posiciona uno al lado del otro

		}

		setInterval(function() {

			$('.player').each(function(){

				$.ajax({
					url: base_url+'api/games/' + $(this).attr('data-game') + '/get',
					crossDomain: true,
					success: function(response) {
						if(response.data.phase === 0)
							$(this).css({'top':($('#player-start').offset().top + 10)})
						else
							$(this).animate({'top':$('#stage_'+(response.data.phase).offset().top + 10)})
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