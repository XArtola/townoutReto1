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
	<div id="player-end"></div>
</div>

<form action="{{route('games.endCaretaker',['circuit'=>$circuit->id])}}" method="post">
	@method('PUT')
	@csrf
	<button type="submit" class="btn btn-danger">
		@lang('games.leave_button')
	</button>
</form>

<script>
	$(function() {

		$('.player').each(function(i){
			if(i === 0)
				$(this).css('right', 40 + 'px');
			else
				$(this).css('right', i*(90 + 20) + 'px'); // los posiciona uno al lado del otro

		});

		setInterval(function() {

			$('.player').each(function(){
				let player = $(this);
				$.ajax({
					url: base_url+'api/games/' + player.attr('data-game') + '/get',
					crossDomain: true,
					success: function(response) {
						if(response.data.phase === 0)
							player.animate({'top':$('#player-start').position().top + 'px'});
						else if(response.data.phase === $('.player').length)
							player.animate({'top':$('#player-end').position().top + 'px'})
						else{
							player.animate({
								'top':  $('#stage_'+response.data.phase).position().top + 'px'
							},500);
						}

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