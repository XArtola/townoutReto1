@extends('layouts.user')
@section('imports')
<script src="{{asset('/assets/js/circuits.js')}}"></script>
@endsection
@section('content')
<div class="row mt-2">
	<div class="alert alert-info col-lg-5 col-sm-12 mx-auto">
		<h1 class="h4 p-2">@lang('circuits.info')</h1>
		<ul class="list-group">
			<li class="list-group-item">
				<h5>@lang('circuits.standard_circuit_title')</h5>
				<p>@lang('circuits.standard_circuit_info')</p>
			</li>
			<li class="list-group-item">
				<h5>Caretaker</h5>
				<p>@lang('circuits.caretaker_info')</p>
			</li>
		</ul>
	</div>
	<div class="col-lg-5 col-sm-11 mx-auto border rounded border-secondary">
		<form action="{{route('circuit.store')}}" id="inputs" method="POST" enctype="multipart/form-data">
			@csrf
			<div class="form-group">
				<label class="col-form-label col-form-label-lg">@lang('circuits.name')</label>
				<input type="text" class="form-control" name="name" value="{{old('name')}}">@if ($errors->has('name'))<span>{{ $errors->first('name')}}</span>@endif
				<span class="error" data-for="c_name"></span>
			</div>
			<div class="form-group">
				<label class="col-form-label col-form-label-lg">@lang('circuits.description')</label>
				<textarea name="description" class="form-control" value="{{old('description')}}"></textarea>
				@if($errors->has('description'))
				<span>{{$errors->first('description')}}</span>
				@endif
				<span class="error" data-for="c_description"></span>
			</div>
			<div class="form-group">
				<label class="col-form-label col-form-label-lg">@lang('circuits.image')</label>
				<input type="file" class="form-control-file" name="image">
			</div>
			<div class="form-group">
				<label class="col-form-label col-form-label-lg">@lang('circuits.city')</label>
				<input type="text" class="form-control" name="city" value="{{old('city')}}"> @if ($errors->has('city'))<span>{{$errors->first('city')}}</span>@endif
				<span class="error" data-for="c_city"></span>
			</div>
			<div class="form-group">
				<label class="col-form-label col-form-label-lg">@lang('circuits.difficulty')</label>
				<select id="difficulty" class="custom-select mr-sm-2" name="difficulty" value="{{old('difficulty')}}">
					<option disabled="" selected="">@lang('circuits.select_diff')</option>
					<option value="easy">@lang('circuits.easy')</option>
					<option value="medium">@lang('circuits.medium')</option>
					<option value="difficult">@lang('circuits.difficult')</option>
				</select>
				@if ($errors->has('difficulty'))<span>{{$errors->first('difficulty')}}</span>@endif
				<span class="error" data-for="c_difficulty" id="c_difficulty"></span>
			</div>
			<div class="form-group">
				<label class="col-form-label col-form-label-lg">@lang('circuits.lang')</label>
				<select id="language" class="custom-select mr-sm-2" name="lang" value="{{old('lang')}}">
					<option value="es" selected>ES</option>
					<option value="en">EN</option>
					<option value="eus">EUS</option>
				</select>
				@if($errors->has('lang'))<span>{{$errors->first('lang')}}</span>@endif
			</div>
			<div class="form-group">
				<label class="col-form-label col-form-label-lg">@lang('circuits.duration')</label>
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
				<button type="button" class="btn btn-primary" id="circuit_create">@lang('circuits.create_button')</button>
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