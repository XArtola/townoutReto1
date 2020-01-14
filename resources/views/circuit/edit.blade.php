@extends('layouts.main')

@section('content')
<div class="container">
	<form action="{{route('circuit.update',['id'=>$circuit->id])}}" method="post">
		@method('PUT')
		@csrf
		<div>
			<label>Name</label>
			<input type="text" name="name" value="{{$circuit->name}}">@if ($errors->has('name'))<span>{{ $errors->first('name')}}</span>@endif
			<span class="error" data-for="c_name"></span>
		</div>
		<div>
			<label>Description of the circuit</label>
			<textarea name="description" value="">{{$circuit->description}}</textarea>@if($errors->has('description'))<span>{{$errors->first('description')}}</span>@endif
			<span class="error" data-for="c_description"></span>
		</div>
		<div>
			<label>Image</label>
			<img src="" alt="circuit_img">
			<input type="file" name="image">
		</div>
		<div>
			<label>City</label>
			<input type="text" name="city" value="{{$circuit->city}}"> @if ($errors->has('city'))<span>{{$errors->first('city')}}</span>@endif
			<span class="error" data-for="c_city"></span>
		</div>
		<div>
			<label>Difficulty</label>
			<select id="difficulty" name="difficulty" value="{{$circuit->dificulty}}">
				<option value="easy">Easy</option>
				<option value="medium">Medium</option>
				<option value="difficult">Difficult</option>
			</select>
			@if ($errors->has('difficulty'))<span>{{$errors->first('difficulty')}}</span>@endif
		</div>
		<div>
			<label>Duration</label>
			<input type="number" name="duration" min="0" max="360" step="5" value="{{$circuit->duration}}">
			@if($errors->has('city'))<span>{{$errors->first('duration')}}</span>@endif
		</div>
		<div>
			@if($circuit->caretaker ===1)
			<input type="checkbox" checked="" name="caretaker"><label>Caretaker</label>
			@elseif($circuit->caretaker === 0)
			<input type="checkbox" name="caretaker"><label>Caretaker</label>
			@endif
		</div>
		<div>
			<button type="submit">Edit</button>
		</div>
		
	</form>
	
</div>