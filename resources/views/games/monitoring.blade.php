@extends('layouts.user')
@section('content')
<div id="stages">

	@php
		$counter = 0;
	@endphp

	@foreach($stages as $stage)

		<div id="stage_{{$stage->id}}" class="stage">
			<h1 class="display-4">{{$counter++}} @lang('circuit.stage')</h1>
		</div>

	@endforeach
	
</div>
<script>
	$(function() {
		let circuit_id = $('#circuit_id').val();
		console.log(circuit_id)
		setInterval(function() {

			$.ajax({
				url: base_url+'api/circuits/' + circuit_id,
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