@extends('layouts.user')
@section('content')
<div class="col-6 mx-auto">
	<h1>Inserta el código para unirte a la partida</h1>
	<form method="POST" action="{{route('games.checkCode')}}">
		@csrf
		<div class="form-group">
			<input type="text" name="caretakerCode" class="form-control">
		</div>
		<div class="form-group text-center">
			<input type="submit" value="join" class="btn btn-primary">
		</div>
	</form>
	
</div>
@endsection