@extends('layouts.user')
@section('imports')
<script src="{{asset('/assets/js/comments.js')}}"></script>
@endsection
@section('imports')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
@endsection
@section('content')
<div id="mapid" style="height:90vh; width:100vw; z-index:2;">
	<div class="col-lg-4 ml-auto mt-auto border border-dark rounded py-1 px-4 shadow-lg p-3 mb-5 bg-white" style="display:fixed; z-index:10; top:15vh; right:15vw;">
		<h2 class="text-center"><span> {{ $game->circuit->name}}</span></h2>
		<h2><i class="fas fa-calendar-alt"></i><span> {{ date_create($game->start_date)->format('Y-m-d')}}</span></h2>
		<h2><i class="fas fa-stopwatch"></i><span>
				<?php
				// Inicializar dos objetos tipo datetime
				$datetime1 = new DateTime($game->start_date);
				$datetime2 = new DateTime($game->finish_date);

				// Guardar diferencia en una variable
				// two DateTime objects 
				$difference = $datetime1->diff($datetime2);

				// Devolver la diferencia

				echo $difference->h . " : " . $difference->i . " : " . $difference->s;
				?>
			</span></h2>
		<div class="text-center mx-auto">
			<span class="btn btn-warning py-3 px-4 font-weight-bold">{{$game->score}}</span>
			@if($game->rating===0)
			<div class="row">
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
			<!--Hay que controlar esto-->
			<div>
				<form method="post" action="{{route('comments.store')}}" id="#comment-form" enctype="multipart/form-data">
					@csrf
					<label>Vote!</label><img src="" alt="punctuation">
					<br>
					<input type="hidden" name="circuit_id" value="{{$game->circuit->id}}">
					<textarea placeholder="Comment us your opinion (optional)" id="comment" name="comment"></textarea>
					@if($errors->has('comment'))<span>{{$errors->first('comment')}}</span>@endif
					<span class="error" data-for="comment"></span>
					<br>
					<button type="sumbit" id="comment_send">Comment</button>
				</form>
			</div>
			<!--Hay que controlar esto-->
		</div>
	</div>
</div>

<div id="locations" style="height:90vh; width:100vw"></div>

<script>
	$(function() {

		let latlngs = [];

		let mymap = L.map('mapid');
		//A	plicar capa de mapa
		L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
			attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://mapbox.com">Mapbox</a>',
			maxZoom: 100,
			id: 'mapbox.streets',
			accessToken: 'pk.eyJ1IjoiYmJyb29rMTU0IiwiYSI6ImNpcXN3dnJrdDAwMGNmd250bjhvZXpnbWsifQ.Nf9Zkfchos577IanoKMoYQ'
		}).addTo(mymap);
console.log('entra')
		$.get('https://townout.herokuapp.com/api/locations/' + $('#id').val() + '/getLocations', function(data, status) {
console.log('entra2')
			for (x in data['data']) {
				for (y in data['data'][x]) {
					$('#locations').append(y + ": " + data['data'][x][y] + "    ");
				}
				$('#locations').append("<br>");
			}

			for (x in data['data']) {
				let latlng = [];
				latlng.push(parseFloat(data['data'][x]['lat']));
				latlng.push(parseFloat(data['data'][x]['lng']));
				//console.log(latlng);
				latlngs.push(latlng);

			}
			console.dir(latlngs)

			var polyline = L.polyline(latlngs, {
				color: 'red'
			}).addTo(mymap);
			// zoom the map to the polyline
			mymap.fitBounds(polyline.getBounds());
		});

	});
</script>


</div>
</div>
@endsection