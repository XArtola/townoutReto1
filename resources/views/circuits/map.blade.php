@extends('layouts.main')
@section('imports')
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
	integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
	crossorigin=""/>
	<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
	integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
	crossorigin=""></script>
@endsection

@section('content')
	<div id="mapid" style="height:100vh;z-index: 4;"></div>
	<div id="form" style="display: none">
		<form style="height: 100vh; position: fixed; bottom:0;left:0; width:30%; background-color: rgba(255,255,255,.7);z-index: 5">
			<input type="hidden" name="lat" id="lat">
			<input type="hidden" name="lng" id="lng">
		</form>
	</div>
@endsection

@section('js')
	$(function(){

		var mymap = L.map('mapid');
		var crd = null;

		var options = {
			enableHighAccuracy: true,
			timeout: 5000,
			maximumAge: 0
		};

		function success(pos) {
			crd = pos.coords;
			let coor = [crd.latitude,crd.longitude];
			console.log(coor)
			sessionStorage.setItem('current_position',coor);
			mymap.setView(coor, 13);
		};

		function error(err) {
			console.warn('ERROR(' + err.code + '): ' + err.message);
			// pone una ubicación por defecto
			crd = [51.505, -0.09];
			sessionStorage.setItem('current_position',crd);
			mymap.setView(crd, 13);
		};
		
		// si no hay un current position guardado en el sessionStorage pregunta si queremos usar la ubicación. Si acepta carga el mapa en función a ella y si no carga una ubicación por defecto.
		if(!sessionStorage.getItem('current_position'))
			navigator.geolocation.getCurrentPosition(success, error, options);

		renderMap();

		// carga el mapa
		function renderMap(){
			if(sessionStorage.getItem('current_position')){
				let coors = sessionStorage.getItem('current_position').split(',');
				let coordinates = [parseFloat(coors[0]), parseFloat(coors[1])];

				console.log(L.titleLayer)
				L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
					attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
					maxZoom: 18,
					id: 'mapbox/streets-v11',
					accessToken: 'pk.eyJ1IjoieGFydG9sYSIsImEiOiJjazQ4bno1bTEwbjI0M2twYThnNDJvcTQ4In0.MVU78eV__a2jJE2VkNTCfQ'
				}).addTo(mymap);

				let markers = $.ajax({
					url: "http://localhost:8000/api/markers/{{$circuit_id}}/",
					method: "GET",
					success: function(data){
						for(let i = 0; i < data.data.length; i++){
							let marker = L.marker(data.data[i]).addTo(mymap);
						}
					},
					error: function(error){
						console.error(error.status)
					}
				});
			}else{
				setTimeout(renderMap,2000);
			}
		}

		let marker = null;
		function onMapClick(e) {
			//alert("You clicked the map at " + e.latlng);
			if(marker)
				marker.setLatLng(e.latlng);
			else
				marker = L.marker(e.latlng).addTo(mymap);
			$('#lat').val(e.latlng.lat);
			$('#lng').val(e.latlng.lng);
			$('#form').slideUp(1000);
			$('#mapid').animate({width:'70vw', marginLeft:'30vw'},1000);
		}
		mymap.on('click', onMapClick);
	});
@endsection