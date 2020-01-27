@extends('layouts.user')
@section('content')
<input type="hidden" name="acces" id="acces" value="{{Auth()->user()->api_token}}">
<div class="row mt-2">
	<div class="col-lg-6 col-sm-12 mx-auto border border-secondary rounded">
		<h3 class="text-uppercase font-weight-bold text-center pt-1">{{$game->circuit->name}}</h3>
		<h4>@lang('circuits.city'):<span class="lead"> {{$game->circuit->city}}</span></h4>
		<h4>@lang('circuits.description'):<span class="lead"> {{$game->circuit->description}}</span></h4>
		<h4>@lang('circuits.difficulty'):<span class="lead"> {{$game->circuit->difficulty}}</span></h4>
		<h4>@lang('circuits.duration'):<span class="lead"> {{$game->circuit->duration}}</span></h4>

	</div>
	<div class="alert alert-info col-lg-4 col-sm-12 p-1 mx-auto text-justify" role="alert">
		<h4 class="alert-heading p-2 text-center">@lang('games.join'){{$game->circuit->name}}</h4>
		<p class="mx-2">@lang('games.wait')</p>
		<p class="mx-2"> @lang('games.leave')</p>
		<form action="{{route('games.destroy',$game->id)}}" action="POST" class="text-center">
			@method('delete')
			<button type="submit" class="btn btn-danger">@lang('games.leave_button')</button>
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
				url: base_url + 'api/circuits/' + circuit_id,
				crossDomain: true,
				headers: {
					'Authorization': `Bearer ` + $('#acces').val(),
				},
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