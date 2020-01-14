@extends('layouts.user')
@section('title','Index')
@section('content')

Caretaker (1) Menú de inicio


<div id="clave" style="background-color: lightgreen; text-align: center">
	<span style=" font-size: 32px;"> {{$random_code}}</span>
	
</div>
<div>
	<h2>Usuarios conectados</h2>
	<ul>
		
	</ul>
</div>
<div>
	<a href=""><button>GO!</button></a>
</div>


@endsection

@section('js')
$(document).ready(function(){
$('table form input[type="button"]').click(function(){
$(this).parent('form').submit();
});
});
@endsection