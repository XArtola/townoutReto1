@extends('layouts.user')
@section('content')
<div class="col-lg-6 col-sm-12 mx-auto py-auto">
	<div class="alert alert-info col-lg-10 col-sm-12 p-1 mx-auto text-justify mt-1" role="alert">
		<h4 class="alert-heading p-2">@lang('games.caretaker_game')</h4>
		<p class="mx-2">@lang('games.caretaker_game_info')</p>
		<p class="mx-2">@lang('games.caretaker_game_add_info')</p>
	</div>
	<form method="POST" id="caretaker_code_form" action="{{route('games.checkCode')}}">
		@csrf
		<div class="form-group">
			<input type="text" id="caretaker_code_input" name="caretaker_code_input" class="form-control">
			<label for="caretakerCode" class="error"></label>
			@foreach ($errors->all() as $error)
                <label class="error">{{ $error }}</label>
            @endforeach
			<label class="error">{{$code_error ?? '' }}</label>
		</div>
		<div class="form-group text-center">
			<input type="button" value="Unirse" id="submit_join_code" class="btn btn-primary">
		</div>
	</form>

</div>
@endsection