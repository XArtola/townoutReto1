@extends('layouts.user')
@section('content')
<div>
	<h1>You joined a new caretaker game wait until participants are ready</h1>
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
					if (response.data.join_code == 'START'){
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