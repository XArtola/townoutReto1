@extends('layouts.user')
@section('content')
<div id="mapid" style="height:90vh; width:100vw"></div>
<div class="col-lg-4 ml-auto mt-auto border border-dark rounded py-1 px-4 shadow-lg p-3 mb-5 bg-white" style="display:relative; z-index:10; top:20vh; right:20vw;">
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
	</div>
</div>
<div>
	<form method="post" action="{{route('comments.store')}}">
		@csrf
		<label>Vote!</label><img src="" alt="punctuation">
		<br>
		<input type="hidden" name="circuit_id" value="{{$game->circuit->id}}">
		<textarea placeholder="Comment us your opinion (optional)" name="comment"></textarea>
		<br>
		<button type="submit">Comment</button>
	</form>




	
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

			$.get('https://townout.herokuapp.com/api/locations', function(data, status) {

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