@extends('layouts.main')
@section('imports')
	<script src="{{asset('/assets/js/circuits.js')}}"></script>
@endsection
@section('content')
<form action="{{route('circuit.store')}}" id="inputs" method="POST" enctype="multipart/form-data">
	@csrf
	<div>
		<label>Name</label>
		<input type="text" name="name" value="{{old('name')}}">@if ($errors->has('name'))<span>{{ $errors->first('name')}}</span>@endif
		<span class="error" data-for="c_name"></span>
	</div>
	<div>
		<label>Description of the circuit</label>
		<textarea name="description" value="{{old('description')}}"></textarea>
		@if($errors->has('description'))
			<span>{{$errors->first('description')}}</span>
		@endif
		<span class="error" data-for="c_description"></span>
	</div>
	<div>
		<label>Image</label>
        <input type="file" name="image">
	</div>
	<div>
		<label>City</label>
		<input type="text" name="city" value="{{old('city')}}"> @if ($errors->has('city'))<span>{{$errors->first('city')}}</span>@endif
		<span class="error" data-for="c_city"></span>
	</div>
	<div>
		<label>Difficulty</label>
		<select id="difficulty" name="difficulty" value="{{old('difficulty')}}">
			<option disabled="" selected="">Select a difficulty</option>
			<option value="easy">Easy</option>
			<option value="medium">Medium</option>
			<option value="difficult">Difficult</option>
		</select>
		@if ($errors->has('difficulty'))<span>{{$errors->first('difficulty')}}</span>@endif
		<span class="error" data-for="c_difficulty" id="c_difficulty"></span>
	</div>
	<div>
		<label>Duration</label>
		<input type="number" name="duration" min="5" max="360" step="5" value="60">
		@if($errors->has('city'))<span>{{$errors->first('duration')}}</span>@endif
		<span class="error" data-for="c_duration"></span>
	</div>
	<div>
		<input type="checkbox" name="caretaker"><label>Caretaker</label>
	</div>
	<div>
		<button type="button" id="circuit_create">Create</button>
	</div>
	
</form>
@if($errors->any())
	@foreach($errors->all() as $error)
		<span class="error">{{$error}}</span>
	@endforeach
@endif
@endsection