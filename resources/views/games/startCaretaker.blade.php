@extends('layouts.user')
@section('content')
<input type="hidden" name="acces" id="acces" value="{{Auth()->user()->api_token}}">
<div class="col-md-6 col-sm-12 mx-auto">
	<div class="alert alert-info col-lg-10 col-sm-12 p-1 mx-auto text-justify" role="alert">
		<h4 class="alert-heading p-2">@lang('games.instructions')</h4>
		<p class="mx-2">@lang('games.instructions_info')</p>
		<p class="mx-2"> @lang('games.instructions_info2')</p>
	</div>
	<h1 class="border border-secondary text-center bg-townout text-light font-weight-bold">{{$circuit->join_code}}</h1>
	<table class="mx-auto py-2 my-2">
		<tr>
			<th>@lang('admin.users')</th>
			<th>@lang('games.state')</th>
		</tr>
		<tbody id="joined_users_table">

		</tbody>
	</table>
</div>

<form action="{{route('circuit.updatejoinCode',$circuit->id)}}" method="POST">
	@csrf
	@method('PUT')
	<input type="hidden" id="id" name="id" value="{{$circuit->id}}">
	<input type="hidden" name="join_code" value="START">
	<div class="text-center">
		<button class="btn btn-primary p-2">Start</button>
	</div>
</form>
<script>
	$(function() {
		let circuit_id = $('#id').val();
		console.log(circuit_id)
		setInterval(function() {

			$.ajax({
				url: base_url + 'api/circuits/' + circuit_id + '/joinedUsers',
				crossDomain: true,
				headers: {
					'Authorization': `Bearer ` + $('#acces').val(),
				},
				success: function(response) {
					console.log('La respuesta de join users es');
					//console.dir(response);
					let tableInfo = "";
					for (x in response.data) {
						console.dir(response.data[x]['username']);
						tableInfo += '<tr><td>' + response.data[x]['username'] + '</td><td class="text-center"><i style="color:green;" class="fas fa-check-circle fa-lg"></i></td></tr>';
					}
					$('#joined_users_table').html(tableInfo);

				},

				error: function(request, status, error) {
					console.log('Error. No se ha podido obtener la información de usuarios: ' + request.responseText + " | " + error);
				},

			});


		}, 5000);

	});
</script>
@endsection