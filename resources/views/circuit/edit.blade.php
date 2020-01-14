@extends('layouts.user')
@section('imports')
<script src="{{asset('/assets/js/circuits.js')}}"></script>
@endsection
@section('content')
<div class="row mt-2">
	
	<div class="col-lg-5 col-sm-11 mx-auto border rounded border-secondary">
		<form action="{{route('circuit.update',['id'=>$circuit->id])}}" id="inputs" method="POST" enctype="multipart/form-data">
			@method('PUT')
			@csrf
			<div class="form-group">
				<label class="col-form-label col-form-label-lg">Name</label>
				<input type="text" class="form-control" name="name" value="{{$circuit->name}}">@if ($errors->has('name'))<span>{{ $errors->first('name')}}</span>@endif
				<span class="error" data-for="c_name"></span>
			</div>
			<div class="form-group">
				<label class="col-form-label col-form-label-lg">Description of the circuit</label>
				<textarea name="description" class="form-control">{{$circuit->description}}</textarea>
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
				<input type="text" class="form-control" name="city" value="{{$circuit->city}}"> @if ($errors->has('city'))<span>{{$errors->first('city')}}</span>@endif
				<span class="error" data-for="c_city"></span>
			</div>
			<div class="form-group">
				<label class="col-form-label col-form-label-lg">Difficulty</label>
				<select id="difficulty" class="custom-select mr-sm-2" name="difficulty" value="{{$circuit->dificulty}}">
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
				@if($circuit->caretaker ===1)
				<input class="form-check-input" type="checkbox" checked="" name="caretaker" id="defaultCheck1"><label>Caretaker</label>
				@elseif($circuit->caretaker === 0)
				<input class="form-check-input" type="checkbox" name="caretaker" id="defaultCheck1"><label class="form-check-label" for="defaultCheck1">Caretaker</label>
				@endif
			</div>


			<div class="form-group text-center">
				<button type="button" class="btn btn-primary" id="circuit_edit">Edit</button>
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