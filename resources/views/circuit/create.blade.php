@extends('layouts.user')
@section('imports')
<script src="{{asset('/assets/js/circuits.js')}}"></script>
@endsection
@section('content')
<div class="row mt-2">
	<div class="alert alert-info col-lg-5 col-sm-12 mx-auto">
		<h1 class="h4 p-2">Información sobre tipos de circuitos</h1>
		<ul class="list-group">
			<li class="list-group-item">
				<h5>Circuito estandar</h5>
				<p>Los circuitos de esta modalidad estarán disponibles para todos los usuarios. Las pruebas y la puntuación serán gestionados de forma automática.</p>
			</li>
			<li class="list-group-item">
				<h5>Caretaker</h5>
				<p>Los circuitos de este tipo pueden tener fases exclusivas pero solo se podran jugar con una persona vigilando. Este tipo de circuito solo podrá realizarse con un código de acceso.</p>
			</li>
		</ul>
	</div>
	<div class="col-lg-5 col-sm-12 mx-auto border rounded border-secondary">
		<form action="{{route('circuit.store')}}" id="inputs" method="POST" enctype="multipart/form-data">
			@csrf
			<div class="form-group">
				<label class="col-form-label col-form-label-lg">Name</label>
				<input type="text" class="form-control" name="name" value="{{old('name')}}">@if ($errors->has('name'))<span>{{ $errors->first('name')}}</span>@endif
				<span class="error" data-for="c_name"></span>
			</div>
			<div class="form-group">
				<label class="col-form-label col-form-label-lg">Description of the circuit</label>
				<textarea name="description" class="form-control" value="{{old('description')}}"></textarea>
				@if($errors->has('description'))
				<span>{{$errors->first('description')}}</span>
				@endif
				<span class="error" data-for="c_description"></span>
			</div>
			<div class="form-group">
				<label class="col-form-label col-form-label-lg">Image</label>
				<input type="file" class="form-control-file" name="image">
			</div>
			<div class="form-group">
				<label class="col-form-label col-form-label-lg">City</label>
				<input type="text" class="form-control" name="city" value="{{old('city')}}"> @if ($errors->has('city'))<span>{{$errors->first('city')}}</span>@endif
				<span class="error" data-for="c_city"></span>
			</div>
			<div class="form-group">
				<label class="col-form-label col-form-label-lg">Difficulty</label>
				<select id="difficulty" class="custom-select mr-sm-2" name="difficulty" value="{{old('difficulty')}}">
					<option disabled="" selected="">Select a difficulty</option>
					<option value="easy">Easy</option>
					<option value="medium">Medium</option>
					<option value="difficult">Difficult</option>
				</select>
				@if ($errors->has('difficulty'))<span>{{$errors->first('difficulty')}}</span>@endif
				<span class="error" data-for="c_difficulty" id="c_difficulty"></span>
			</div>
			<div class="form-group">
				<label class="col-form-label col-form-label-lg">Duration</label>
				<input type="number" class="form-control" name="duration" min="5" max="360" step="5" value="60">
				@if($errors->has('city'))<span>{{$errors->first('duration')}}</span>@endif
				<span class="error" data-for="c_duration"></span>
			</div>

			<div class="form-check">
				<input class="form-check-input" type="checkbox" name="caretaker" id="defaultCheck1">
				<label class="form-check-label" for="defaultCheck1">
					Caretaker
				</label>
			</div>

			<div class="form-group text-center">
				<button type="button" class="btn btn-primary" id="circuit_create">Create</button>
			</div>

		</form>
	</div>
</div>
@if($errors->any())
@foreach($errors->all() as $error)
<span class="error">{{$error}}</span>
@endforeach
@endif
@endsection