@extends('layouts.user')
@section('content')
<div class="row mt-2">
	<div class="col-lg-6 col-sm-12 mx-auto border border-secondary rounded">
		<h3 class="text-uppercase font-weight-bold text-center pt-1">{{$game->circuit->name}}</h3>
		<h4>Ciudad:<span class="lead"> {{$game->circuit->city}}</span></h4>
		<h4>Descripción:<span class="lead"> {{$game->circuit->description}}</span></h4>
		<h4>Dificultad:<span class="lead"> {{$game->circuit->difficulty}}</span></h4>
		<h4>Duración:<span class="lead"> {{$game->circuit->duration}}</span></h4>

	</div>
	<div class="alert alert-info col-lg-4 col-sm-12 p-1 mx-auto text-justify" role="alert">
		<h4 class="alert-heading p-2 text-center">Te has unido a una partida del circuito {{$game->circuit->name}}</h4>
		<p class="mx-2">Espera hasta que el guia comience la partida.</p>
		<p class="mx-2"> Puedes abandonar la partida, pero no aparecerá en tu historial</p>
		<form action="{{route('games.destroy',$game->id)}}" action="POST" class="text-center">
			@method('delete')
			<button type="submit" class="btn btn-danger">Dejar partida</button>
		</form>
	</div>

</div>

<div style="display:none">
	<input type="hidden" id="circuit_id" value="{{$game->circuit->id}}">
	<a id="start_game" href="{{route('games.index',['id'=>$game->id])}}"></a>
</div>
<script>
	$(function() {
		let circuit_id = $('#circuit_id').val();
		console.log(circuit_id)
		setInterval(function() {

			$.ajax({
				url: 'http://localhost:8000/api/circuits/' + circuit_id,
				crossDomain: true,
				success: function(response) {
					console.log('La respuesta circuito: (codigo join)')
					console.dir(response.data.join_code);
					if (response.data.join_code == 'START') {
						console.log('entra')
						console.log($('#start_game').attr('href'));
						location.href = $('#start_game').attr('href');
					}
				},
				error: function(request, status, error) {
					console.log('Error. No se ha podido obtener la información de circuito: ' + request.responseText + " | " + error);
				},

			});


		}, 5000);

	});
</script>
@endsection