@extends('layouts.user')
@section('title') {{$circuit->name}} @endsection
@section('content')
<input type="hidden" name="acces" id="acces" value="{{Auth()->user()->api_token}}">
<div class="col-md-6 col-sm-12 mx-auto">
	<div class="alert alert-info col-lg-10 col-sm-12 p-1 mx-auto text-justify" role="alert">
		<h4 class="alert-heading p-2">@lang('games.instructions')</h4>
		<p class="mx-2">@lang('games.instructions_info')</p>
		<p class="mx-2"> @lang('games.instructions_info2')</p>
	</div>
	<h1 class="border border-secondary text-center bg-dark text-light font-weight-bold">{{$circuit->join_code}}</h1>
	<table class="mx-auto py-2 mb-2 mt-5">
		<thead id="table-title">
			<tr>
				<th class="py-2 px-4 border border-secondary bg-dark text-light">@lang('admin.users')</th>
				<th class="py-2 px-4 border border-secondary bg-dark text-light">@lang('games.state')</th>
			</tr>
		</thead>
		<tbody id="joined_users_table">

		</tbody>
	</table>
	<p id="message" class="text-center display-4" style="font-size: 18px">@lang('circuits.waiting_players')</p>
</div>

<form action="{{route('circuit.updatejoinCode',$circuit->id)}}" method="POST">
	@method('PUT')
	@csrf
	<input type="hidden" id="id" name="id" value="{{$circuit->id}}">
	<input type="hidden" name="game_ids" id="game_ids">
	<input type="hidden" name="join_code" value="START">
	<div class="text-center">
		<button class="btn btn-primary p-2 startbutton">Start</button>
	</div>
</form>
<script>
	$(function() {
		let circuit_id = $('#id').val();
		$('.startbutton, #table-title').hide();
		setInterval(function() {

			$.ajax({
				url: base_url + 'api/circuits/' + circuit_id + '/joinedUsers',
				crossDomain: true,
				headers: {
					'Authorization': `Bearer ` + $('#acces').val(),
				},
				success: function(response) {
					let tableInfo = "";
					// si no hay ningún usuario conectado
					if(response.data.games.length > 0 && $('#table-title').css('display') === 'none'){
						$('#message').fadeOut(100);
						$('#table-title').fadeIn(500);
						$('.startbutton').fadeIn(500);
					}else if(response.data.games.length === 0){
						$('#table-title').fadeOut(100);
						$('.startbutton').fadeOut(100);
						$('#message').fadeIn(500);
					}
					for (x in response.data.games) {
						tableInfo += '<tr><td class="py-2 px-4 border border-secondary text-center">' + response.data.games[x]['username'] + '</td><td class="text-center py-2 px-4 border border-secondary"><i style="color:green;" class="fas fa-check-circle fa-lg"></i></td></tr>';
					}
					$('#joined_users_table').html(tableInfo);
					$('#game_ids').val(response.data.game_ids);
				},

				error: function(request, status, error) {
					console.log('Error. No se ha podido obtener la información de usuarios: ' + request.responseText + " | " + error);
				},

			});

		}, 5000);

	});
</script>
@endsection