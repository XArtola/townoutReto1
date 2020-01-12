@extends('layouts.user')
@section('content')
<div class="col-6 mx-auto">
	<h1 class="border border-secondary">{{$circuit->join_code}}</h1>
	<table>
		<th>Username</th>
		<tr></tr>
	</table>
</div>

<form action="{{route('circuit.update',$circuit->id)}}" method="POST">
	@csrf
	@method('PUT')
	<input type="hidden" name="id" value="{{$circuit->id}}">
	<input type="hidden" name="join_code" value="START">
	<div class="text-center">
		<button class="btn btn-primary">Start</button>
	</div>
</form>

<script>
	$(function() {
		let circuit_id = $('#id').val();
		console.log(circuit_id)
		setInterval(function() {

			$.ajax({
				url: 'http://localhost:8000/api/circuits/' + circuit_id,
				crossDomain: true,
				success: function(response) {
					console.log('La respuesta circuito: (codigo join)')
					console.dir(response.data.join_code);
					if (response.data.join_code == null) {
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