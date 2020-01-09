@extends('layouts.main')
@section('content')
<form action="{{route('circuit.store')}}" method="post">
	@csrf
	<div>
		<label>Name</label>
		<input type="text" name="name" value="{{old('name')}}">@if ($errors->has('name'))<span>{{ $errors->first('name')}}</span>@endif
		<span class="error" data-for="c_name"></span>
	</div>
	<div>
		<label>Description of the circuit</label>
		<textarea name="description" value="{{old('description')}}"></textarea>@if($errors->has('description'))<span>{{$errors->first('description')}}</span>@endif
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
			<option>Easy</option>
			<option>Medium</option>
			<option>Difficult</option>
		</select>
		@if ($errors->has('difficulty'))<span>{{$errors->first('difficulty')}}</span>@endif
	</div>
	<div>
		<label>Duration</label>
		<input type="number" name="duration" min="0" max="180" step="5" value="60">
		@if($errors->has('city'))<span>{{$errors->first('duration')}}</span>@endif
	</div>
	<div>
		<input type="checkbox" name="caretaker"><label>Caretaker</label>
	</div>
	<div>
		<button id="circuit_create">Create</button>
	</div>
	
</form>
@endsection