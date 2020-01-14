@extends('layouts.user')
@section('content')
	@php
		$counter = 0;
	@endphp

	@foreach($games[0]->circuit->stages as $stage)
		<div style="border:.5px solid #cccccc; margin: 5px 0; padding:2em; font-style: 1em; color:#7d7d7d" class="col-12 row">
			<h1 style="width:50%">{{$counter++}}.{{$stage->question_text}}</h1>
			<div style="width:50%" class="users">
				
				@foreach($games as $game)
					@if($game->phase == $counter - 1)
						{{$game->user->username}}
					@endif
				@endforeach

			</div>
		</div>	
	@endforeach

@endsection