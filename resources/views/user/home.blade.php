@extends('layouts.main')
@section('title','Index')
@section('content')
<div id="all_circuits">
	<h1>Circuitos disponibles</h1>
	<div class="row">
		@foreach($circuits as $circuit)
		<div class="col">
			<h2>Name: {{$circuit->name}}</h2>
			<p>Creator: {{$circuit->user->name}}</p>
			<p>Location: {{$circuit->city}}</p>
			<p>Estimated time: {{$circuit->duration}}</p>
			<p>Difficulty:{{$circuit->dificulty}}</p>
		</div>
		@endforeach
	</div>
	<div>
		<button>Unirse a un circuito</button>
		<a href=""><button>New Circuit</button></a>
	</div>
	
</div>

<!-- Futura implementación -->
<!--
<div>
	<h1>My Circuits</h1>
</div>
-->
@endsection

@section('js')
$(document).ready(function(){
$('table form input[type="button"]').click(function(){
$(this).parent('form').submit();
});
});
@endsection