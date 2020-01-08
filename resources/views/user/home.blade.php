@extends('layouts.main')
@section('title','Index')
@section('content')

@foreach($circuits as $circuit)
<div>
	<h2>Name: $circuit->name</h2>
	<p>Creator: $circuit->user_id</p>
	<p>Location: $circuit->location</p>
	<p>Estimated time: &circuit->duration</p>
	<p>$circuit->difficulty</p>
</div>
@endforeach
@endsection

@section('js')
    $(document).ready(function(){
        $('table form input[type="button"]').click(function(){
            $(this).parent('form').submit();
        });
    });
@endsection