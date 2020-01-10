@extends('layouts.main')
@section('content')
		<div>
			<h1>GAME OVER!</h1>
			<div>
				
				<p>{{$game->score}}</p>
				
			</div>
		</div>
		<div>
			<form method="post" action="{{route('comments.store')}}">
				@csrf
				<label>Vote!</label><img src="" alt="punctuation">
				<br>
				<input type="hidden" name="circuit_id" value="{{$game->circuit->id}}">
				<textarea placeholder="Comment us your opinion (optional)" name="comment"></textarea>
				<br>
				<button type="submit">Comment</button>
			</form>
			
		</div>
	</div>
@endsection