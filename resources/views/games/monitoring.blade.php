@extends('layouts.user')
@section('imports')
	<link rel="stylesheet" type="text/css" href="{{asset('/assets/css/game.css',\App::environment() == 'production')}}">
	<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
@endsection
@section('content')
	<input type="hidden" name="acces" id="acces" value="{{Auth()->user()->api_token}}">
	<input type="hidden" name="circuitid" id="circuitid" value="{{$circuit->id}}">
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
			{{$game->id}}
			<div class="player" data-game="{{$game->id}}">
				{{strtoupper(substr($game->user->name,0,1)).strtoupper(substr($game->user->surname,0,1))}}
			</div>
		@endforeach
		<div id="player-end"></div>
	</div>
	
	<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#endGameModal">
		@lang('games.leave_button')
	</button>
	<div class="modal fade" id="endGameModal" tabindex="-1" role="dialog" aria-labelledby="endGameModalTitle" aria-hidden="true">
	    <div class="modal-dialog modal-dialog-centered" role="document">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <h5 class="modal-title" id="exampleModalLongTitle">@lang('games.quieres_mantener_partida')</h5>
	                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                        <span aria-hidden="true">&times;</span>
	                    </button>
	                </div>
	                <div class="modal-body column">
	                	<span style="font-style: italic;">@lang('games.aviso_terminar_partida')</span>
	                	<div class="row space-between">
		                	<form action="{{route('games.endCaretaker',['circuit'=>$circuit->id])}}" method="post">
								@method('PUT')
								@csrf
		                    	<button id="finishGame" class="btn btn-danger">@lang('games.leave_button')</button>
		                    </form>
		                    <form>
		                    	@csrf
			                    <button id="" class="btn btn-success">@lang('games.mantener_partida')</button>
		                    </form>
		                </div>
	                </div>

	            </div>

	        </div>
	    </div>
	</div>

<script>
	$(function() {

		$('.player').each(function(i){
			if(i === 0)
				$(this).css('right', 40 + 'px');
			else
				$(this).css('right', i*(90 + 20) + 'px'); // los posiciona uno al lado del otro

		});

		var games = null;
		let starting = true;
		console.log(base_url)
		setInterval(function() {

			$.ajax({
				url: base_url+'api/games/'+$('#circuitid').val()+'/activeGames',
				crossDomain: true,
				headers: {
                    'Authorization': `Bearer ` + $('#acces').val(),
                },
				success: function(response) {
					games = response.data;
					for(let i = 0; i < response.data.length ; i++){
						let game = response.data[i];
						let player = $('.player[data-game="'+game.id+'"]');
						if(starting){//response.data.phase === 0) //start
							player.animate({'top':$('#player-start').position().top + 'px'});
							starting = false;
						}
						if(game.finish_date) //finish
							player.animate({'top': $('#player-end').position().top + 'px'});
						else{
							player.animate({
								'top':  $('#stage_'+game.phase).position().top + 'px'
							},500);
						}
					}

				},
				error: function(request, status, error) {
					return request;
					//console.log('Error. No se ha podido obtener la información de los juegos: ' + request.responseText + " | " + error);
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


		}, 7500);
	
	});
</script>
@endsection