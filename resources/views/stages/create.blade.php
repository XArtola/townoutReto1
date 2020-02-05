@extends('layouts.user')
@section('imports')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>

@endsection

@section('content')
<input type="hidden" name="acces" id="acces" value="{{Auth()->user()->api_token}}">
<div id="mapid" style="height:100vh;z-index: 4;">
	<div id="finish_stage_creation" style="position: absolute; bottom:15vh;right:5vw; z-index:1000">
		<a href="{{route('user.home')}}">
			<button type="button" class="btn btn-danger">@lang('stages.finish')</button>
		</a>
	</div>
</div>
<div id="form" style="display: none;">
	<div style="height: 100vh; position: fixed; bottom:0;left:0;top:15vh; width:30%; background-color: rgba(255,255,255,.7);z-index: 5; overflow-y:scroll;">
		<div class="form-group col-6 mx-auto text-center">
			<label class="col-form-label col-form-label-lg">@lang('stages.type')</label>
			<select class="custom-select mr-sm-2" id="selector">
				<option value="text" selected>@lang('stages.text')</option>
				<option value="quiz">@lang('stages.quiz')</option>
				@if($circuit->caretaker)<option value="img">@lang('stages.img')</option>@endif
			</select>
		</div>
		<form id="textForm" method="POST" class="col-10 border border-secondary rounded mx-auto" action="{{route('stages.store')}}" enctype="multipart/form-data">
			@csrf
			<div class="form-group">
				<label class="col-form-label col-form-label-lg">@lang('stages.q_text')</label>
				<input type="text" class="form-control" name="question_text" value={{old('question_text')}}>
				{!! $errors->first('question_text','<span>:message</span>')!!}
				<span class="error" data-for="question_text"></span>

			</div>
			<div class="form-group">
				<label class="col-form-label col-form-label-lg">@lang('stages.q_img')</label>

				<input type="file" class="form-control-file" name="question_image">
			</div>
			<input type="hidden" name="lat" class="lat">
			<input type="hidden" name="lng" class="lng">
			<input type="hidden" name="order" class="order">
			<input type="hidden" name="circuit_id" value="{{$circuit->id}}">
			<input type="hidden" name="stage_type" value="text">
			<div class="form-group">
				<label class="col-form-label col-form-label-lg">@lang('stages.answer')</label>
				<input type="text" class="form-control" name="answer" value={{old('answer')}}>
				{!! $errors->first('answer','<span>:message</span>')!!}
				<span class="error" data-for="answer"></span>

			</div>
			<div class="form-group text-right">
				<button type="button" class="btn btn-primary" id="submitText">@lang('stages.submit')</button>
			</div>
		</form>

		<form id="quizForm" method="POST" class="col-10 border border-secondary rounded mx-auto" action="{{route('stages.store')}}" enctype="multipart/form-data">
			@csrf

			<div class="form-group">

				<label class="col-form-label col-form-label-lg">@lang('stages.q_text')</label>
				<input type="text" class="form-control" name="question_text" value={{old('question_text')}}>
				{!! $errors->first('question_text','<span>:message</span>')!!}
				<span class="error" data-for="question_text"></span>

			</div>
			<div class="form-group">
				<label class="col-form-label col-form-label-lg">@lang('stages.q_img')</label>
				<input type="file" class="form-control-file" name="question_image">
			</div>
			<input type="hidden" name="lat" class="lat">
			<input type="hidden" name="lng" class="lng">
			<input type="hidden" name="order" class="order">
			<input type="hidden" name="circuit_id" value="{{$circuit->id}}">
			<input type="hidden" name="stage_type" value="quiz">
			<div class="form-group">
				<label class="col-form-label col-form-label-lg">@lang('stages.correct_answer')</label>
				<input type="text" class="form-control" name="correct_ans" value={{old('correct_ans')}}>
				{!! $errors->first('correct_ans','<span>:message</span>')!!}
				<span class="error" data-for="correct_ans"></span>

			</div>
			<div class="form-group">
				<label class="col-form-label col-form-label-lg">@lang('stages.possible_answer1')</label>
				<input type="text" class="form-control" name="possible_ans1" value={{old('possible_ans1')}}>
				{!! $errors->first('possible_ans1','<span>:message</span>')!!}
				<span class="error" data-for="possible_ans1"></span>

			</div>
			<div class="form-group">
				<label class="col-form-label col-form-label-lg">@lang('stages.possible_answer2')</label>
				<input type="text" class="form-control" name="possible_ans2" value={{old('possible_ans2')}}>
				{!! $errors->first('possible_ans2','<span>:message</span>')!!}
				<span class="error" data-for="possible_ans2"></span>

			</div>
			<div class="form-group">
				<label class="col-form-label col-form-label-lg">@lang('stages.possible_answer3')</label>
				<input type="text" class="form-control" name="possible_ans3" value={{old('possible_ans3')}}>
				{!! $errors->first('possible_ans3','<span>:message</span>')!!}
				<span class="error" data-for="possible_ans3"></span>

			</div>
			<div class="form-group text-right">
				<button type="button" class="btn btn-primary" id="submitQuiz">@lang('stages.submit')</button>
			</div>
		</form>

		<form id="imgForm" method="POST" action="{{route('stages.store')}}" enctype="multipart/form-data" class="col-10 border border-secondary rounded mx-auto">
			@csrf
			<div class="form-group">
				<label class="col-form-label col-form-label-lg">@lang('stages.q_text')</label>
				<input type="text" name="question_text" value={{old('question_text')}}>
				{!! $errors->first('question_text','<span>:message</span>')!!}
				<span class="error" data-for="question_text"></span>
			</div>
			<div class="form-group">
				<label class="col-form-label col-form-label-lg">('stages.q_img')</label>
				<input type="file" class="form-control-file" name="question_image">
			</div>
			<input type="hidden" name="lat" class="lat">
			<input type="hidden" name="lng" class="lng">
			<input type="hidden" name="order" class="order">
			<input type="hidden" name="circuit_id" value="{{$circuit->id}}">
			<input type="hidden" name="stage_type" value="img">
			<div class="form-group text-right">
				<button type="button" class="btn btn-primary" id="submitImg">@lang('stages.submit')</button>
			</div>
		</form>
	</div>
</div>
<script src="{{asset('/assets/js/stages.js',\App::environment() == 'production')}}"></script>
@endsection

@section('js')

	$(function() {

		var mymap = L.map('mapid');
		var crd = null;

		var options = {
			enableHighAccuracy: true,
			timeout: 5000,
			maximumAge: 0
		};

		function success(pos) {
			crd = pos.coords;
			let coor = [crd.latitude, crd.longitude];
			console.log(coor)
			sessionStorage.setItem('current_position', coor);
			mymap.setView(coor, 30);
		};

		function error(err) {
			console.warn('ERROR(' + err.code + '): ' + err.message);
			// pone una ubicación por defecto
			crd = [43.31283, -1.97499];
			sessionStorage.setItem('current_position', crd);
			mymap.setView(crd, 30);
		};

		// si no hay un current position guardado en el sessionStorage pregunta si queremos usar la ubicación. Si acepta carga el mapa en función a ella y si no carga una ubicación por defecto.
		if (!sessionStorage.getItem('current_position'))
			navigator.geolocation.getCurrentPosition(success, error, options);

		renderMap();

		// carga el mapa
		function renderMap() {
			if (sessionStorage.getItem('current_position')) {
				let coors = sessionStorage.getItem('current_position').split(',');
				let coordinates = [parseFloat(coors[0]), parseFloat(coors[1])];
				console.log(coordinates)
				mymap.setView(coordinates, 13);
				L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
					attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
					maxZoom: 18,
					id: 'mapbox/streets-v11',
					accessToken: 'pk.eyJ1IjoieGFydG9sYSIsImEiOiJjazQ4bno1bTEwbjI0M2twYThnNDJvcTQ4In0.MVU78eV__a2jJE2VkNTCfQ'
				}).addTo(mymap);
				console.log($('#acces').val())
				let markers = $.ajax({
					url: base_url+"api/markers/{{$circuit->id}}",
					method: "GET",
					headers: {
        				'Authorization': `Bearer `+$('#acces').val(),
    				},
					success: function(data) {
						console.log('información recibida');
						console.log(data)
						if (data.data.length === 0)
							$('#finish_stage_creation').hide();
						for (let i = 0; i < data.data.length; i++) {
							let marker = L.marker(data.data[i]).addTo(mymap);
						}
						if (data.data.length === 0) {
							$('.order').val(1);
						} else {
							$('.order').val((data.data.length + 1));
						}
					},
					error: function(error) {
						console.error(error.status)
					}
				});
			} else {
				setTimeout(renderMap, 2000);
			}
		}
		let marker = null;

		function onMapClick(e) { //alert("You clicked the map at " + e.latlng);
			if (marker)
				marker.setLatLng(e.latlng);
			else
				marker = L.marker(e.latlng).addTo(mymap);
			$('.lat').val(e.latlng.lat);
			$('.lng').val(e.latlng.lng);
			$('#form').fadeIn(1000);
			$('#mapid').animate({
				width: '70vw',
				marginLeft: '30vw'
			}, 1000);
		}
		mymap.on('click', onMapClick);
	});

@endsection