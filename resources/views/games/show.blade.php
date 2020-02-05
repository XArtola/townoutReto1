@extends('layouts.user')
@section('imports')
<script src="{{asset('/assets/js/comments.js',\App::environment() == 'production')}}"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
@endsection
@section('content')
<input type="hidden" name="acces" id="acces" value="{{Auth()->user()->api_token}}">
<input type="hidden" id="game_id" value="{{$game->id}}">

<div class="mx-auto py-3 col-sm-12 col-md-12 col-lg-6 col-12" style="display: flex; align-items: center;flex-direction: column;">
	<div style="display: flex; flex-direction: column;align-items: flex-start;">
		<h2 class="text-center"><span> {{ $game->circuit->name}}</span></h2>
		<h2><i class="fas fa-calendar-alt"></i><span> {{ date_create($game->start_date)->format('Y-m-d')}}</span></h2>
		<h2><i class="fas fa-stopwatch"></i><span>
				@php

				// Inicializar dos objetos tipo datetime
				$datetime1 = new DateTime($game->start_date);
				$datetime2 = new DateTime($game->finish_date);

				// Guardar diferencia en una variable
				// two DateTime objects
				$difference = $datetime1->diff($datetime2);

				// Devolver la diferencia

				//echo $difference->H . " : " . $difference->I . " : " . $difference->S;
				echo $difference->format('%H : %I : %S');;

				@endphp
			</span></h2>

		<h2>Bonus:<span>
				@php
				$bonus = $game->circuit->duration - (intval($difference->format('%h')) * 60 + intval($difference->format('%i')));
				if ($bonus < 0) $bonus=0; echo $bonus; @endphp </span> </h2> <div class="text-center mx-auto my-3">
					<span class="btn btn-warning py-3 px-4 font-weight-bold">{{intval($game->score)+$bonus}}</span>
					@if(!$game->rating)
					<div class="row">
						<label class="col-12 col-form-label col-form-label-lg">@lang('games.vote')</label>
						<form class="col-6" action="{{route('games.setRating',[$game->id])}}" method="POST">
							@csrf
							@method('put')
							<input type="hidden" name="id" id="id" value="{{$game->id}}">
							<input type="hidden" name="rating" id="rating" value="1">
							<button type="sumbit" class="btn"><i class="fas fa-thumbs-up fa-2x" style="color:green"></i></button>
						</form>
						<form class="col-6" action="{{route('games.setRating',[$game->id])}}" method="POST">
							@csrf
							@method('put')
							<input type="hidden" name="id" id="id" value="{{$game->id}}">
							<input type="hidden" name="rating" id="rating" value="-1">
							<button type="sumbit" class="btn"><i class="fas fa-thumbs-down fa-2x" style="color:red"></i></button>
						</form>
					</div>
					@endif

					@if(!$game->circuit->comments->where('user_id',auth()->user()->id)->first())
					<div>
						<form method="post" action="{{route('comments.store')}}" id="#comment">
							@csrf
							<div class="form-group">
								<label class="col-12 col-form-label col-form-label-lg">@lang('games.comment')!</label>

								<input type="hidden" name="circuit_id" value="{{$game->circuit->id}}">
								<textarea id="comment" class="form-control" name="comment"></textarea>
							</div>
							@if($errors->has('comment'))<span>{{$errors->first('comment')}}</span>@endif
							<span class="error" data-for="comment"></span>
							<br>
							<button type="submit" class="btn btn-primary" id="comment_send">@lang('games.send')</button>
						</form>
					</div>

					@endif
	</div>

	@if(!$game->circuit->comments->find(auth()->user()->id))
	<div>
		<form method="post" action="{{route('comments.store')}}" id="#comment">
			@csrf
			<div class="form-group">
				<label class="col-12 col-form-label col-form-label-lg">@lang('games.comment')!</label>

				<input type="hidden" name="circuit_id" value="{{$game->circuit->id}}">
				<textarea id="comment" class="form-control" name="comment"></textarea>
			</div>
			@if($errors->has('comment'))<span>{{$errors->first('comment')}}</span>@endif
			<span class="error" data-for="comment"></span>
			<br>
			<button type="submit" class="btn btn-primary" id="comment_send">@lang('games.send')</button>
		</form>
	</div>

	@endif
</div>
<div id="mapid" style="height:20vh; width:100%; z-index:2;" class="my-3"></div>
</div>

<script>
	$(function() {
    	const base_url = "{{asset('/',\App::environment() == 'production')}}";

		$('#mapid').click(function() {
			$(this).animate({
				'height': '80vh',
				'width': $(window).width() < 800 ? '100vw' : '80vw'
			});
		});

		console.log($('#game_id').val())
		let latlngs = [];
		let mymap = L.map('mapid');
		//Aplicar capa de mapa
		L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
			attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://mapbox.com">Mapbox</a>',
			maxZoom: 100,
			id: 'mapbox.streets',
			accessToken: 'pk.eyJ1IjoiYmJyb29rMTU0IiwiYSI6ImNpcXN3dnJrdDAwMGNmd250bjhvZXpnbWsifQ.Nf9Zkfchos577IanoKMoYQ'
		}).addTo(mymap);

		$.ajax({
			url: base_url + 'api/locations/' + $('#game_id').val() + '/getLocations',
			crossDomain: true,
			headers: {
				'Authorization': `Bearer ` + $('#acces').val(),
			},
			success: function(data) {
				console.log(data)
				if (data.length != 0) {
					for (let x = 0; x < data.length; x++) {
						//console.dir(typeof(data[x].lat));
						let latlng = [];
						latlng.push(parseFloat(data[x].lat));
						latlng.push(parseFloat(data[x].lng));
						if (latlngs.length != 0) {
							if (!(latlngs[latlngs.length - 1][0] === latlng[0] && latlngs[latlngs.length - 1][1] === latlng[1]))
								latlngs.push(latlng);
						} else
							latlngs.push(latlng);
					}

					if (latlngs.length == 1) {
						mymap.setView(latlngs[0], 13);
						var circleCenter = latlngs[0];

						var circleOptions = {
							color: 'red',
							fillColor: '#f03',
							fillOpacity: 0
						}

						var circle = L.circle(circleCenter, 50, circleOptions);

						circle.addTo(mymap);

					} else {
						var polyline = L.polyline(latlngs, {
							color: 'red'
						}).addTo(mymap);
						// Centra el mapa a la polilinea
						mymap.fitBounds(polyline.getBounds());
					}
				}

			},
			error: function(request, status, error) {
				console.log('Error. No se ha podido obtener la información de localizaciones: ' + request.responseText + " | " + error);
			},

		});

	});
</script>


</div>
</div>
@endsection