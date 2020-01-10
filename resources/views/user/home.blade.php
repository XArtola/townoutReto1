@extends('layouts.user')
@section('title','Index')
@section('content')
<div id="all_circuits">
	<h1 class="bg-info">Circuitos disponibles</h1>
	<div class="row">
		@foreach($circuits as $circuit)
		<div class="card m-auto p-3">
			<h2>Name: {{$circuit->name}}</h2>
			<p>Creator: {{$circuit->user->name}}</p>
			<p>Location: {{$circuit->city}}</p>
			<p>Estimated time: {{$circuit->duration}}</p>
			<p>Difficulty:{{$circuit->dificulty}}</p>
		</div>
		@endforeach
	</div>
	<div>
		<button>Join to a circuit</button>
	</div>
	
</div>



<div>
	<h1 class="bg-info">My Circuits</h1>
	<div class="row">
		
		
		@foreach($circuits as $circuit)
		@if(Auth::user()->id==$circuit->user->id)
		<div class="card m-auto p-3">
			<h2>Name: {{$circuit->name}}</h2>
			<p>Creator: {{$circuit->user->name}}</p>
			<p>Location: {{$circuit->city}}</p>
			<p>Estimated time: {{$circuit->duration}}</p>
			<p>Difficulty:{{$circuit->dificulty}}</p>
		</div>
		
		@endif
		@endforeach
		
	</div>
	<div>
		<a href="{{route('circuit.create')}}"><button>New Circuit</button></a>
	</div>

</div>

@endsection

@section('js')
$(document).ready(function(){
$('table form input[type="button"]').click(function(){
$(this).parent('form').submit();
});
});
@endsection