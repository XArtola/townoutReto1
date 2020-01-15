@extends('layouts.user')
@section('content')
<div class="col-6 mx-auto">
	<div class="alert alert-info col-lg-10 col-sm-12 p-1 mx-auto text-justify mt-1" role="alert">
		<h4 class="alert-heading p-2">Unirse a una partida Caretaker</h4>
		<p class="mx-2">Si vas a participar en una partida guiada introduce aqui la clave que el caretaker te ha proporcionado</p>
		<p class="mx-2">Si el código es válido se creara una partida  y tendras que esperar a que se redirija</p>
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