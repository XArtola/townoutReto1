@extends('layouts.user')
@section('title','Index')
@section('content')
<div id="all_circuits" class="p-1">

	<div class="row bg-warning my-4">
		<h1 class="text-light text-uppercase lead col-12 font-weight-bold p-2 mx-4">Circuitos disponibles</h1>

		@foreach($circuits as $circuit)
		@if($circuit->caretaker == 0)
		<div class="card my-2 mx-4" style="width: 18rem;">
			@isset($circuit->image)
			<img src="{{asset('/storage/circuits/'.$circuit->image)}}" class="card-img-top" alt="">
			@else
			<img src="{{asset('assets/img/logoPNG.png')}}" class="card-img-top p-1" alt="">
			@endisset
			<div class="card-body">
				<h5 class="card-title text-uppercase font-weight-bold">{{$circuit->name}}</h5>
				<p class="card-text pl-4"><i class="fas fa-lg fa-globe-europe"></i> {{$circuit->city}}</p>
				<p class="card-text pl-4"><i class="fas fa-lg fa-stopwatch"></i> {{$circuit->duration}}</p>

				<div class="row py-2 text-center mx-auto">
					<h4><i class="fas fa-thumbs-up fa-1x col-3 mx-auto" style="color:grey"></i> <span class="col-3 mx-auto">{{$circuit->games->where('rating',1)->count()}}</span></h4>
					<h4><i class="fas fa-thumbs-down fa-1x col-3 mx-auto" style="color:grey"></i><span class="col-3 mx-auto">{{$circuit->games->where('rating',-1)->count()}}</span></h4>
				</div>

				<div class="text-center">
					<a href="{{route('games.newGame',$circuit->id)}}"><button class="btn btn-primary">Jugar</button></a>
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#c_info">
						Info
					</button>
					<!-- The Modal -->
					<div class="modal" id="c_info">
						<div class="modal-dialog">
							<div class="modal-content">

								<!-- Modal Header -->
								<div class="modal-header">
									<h4 class="modal-title">{{$circuit->name}}</h4>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>

								<!-- Modal body -->
								<div class="modal-body">
									<p>{{$circuit->description}}</p>
									<p>Location: {{$circuit->city}}</p>
									<p>Estimated time: {{$circuit->duration}}</p>
									<p>Difficulty: {{$circuit->difficulty}}</p>
									<p>Created by: {{$circuit->user->username}}</p>

									@if($circuit->caretaker == 1)
									<p>With caretaker</p>
									@endif
								</div>

								<!-- Modal footer -->
								<div class="modal-footer">
									<button type="button" class="btn btn-danger" data-dismiss="modal">Play!</button>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endif
		@endforeach
	</div>
</div>
<div id="my_circuits" class="p-1">

	<div class="row bg-info my-4">
		<h1 class="text-light text-uppercase lead col-12 font-weight-bold p-2 mx-4">Mis circuitos</h1>

		@foreach($circuits as $circuit)
		@if(Auth::user()->id==$circuit->user->id)
		<div class="card my-2 mx-4" style="width: 18rem;">
			@isset($circuit->image)
			<img src="{{asset('/storage/circuits/'.$circuit->image)}}" class="card-img-top" alt="">

			@else
			<img src="{{asset('assets/img/logoPNG.png')}}" class="card-img-top p-1" alt="">
			@endisset
			<div class="card-body">
				<h5 class="card-title text-uppercase font-weight-bold">{{$circuit->name}}</h5>
				<p class="card-text pl-4"><i class="fas fa-lg fa-globe-europe"></i> {{$circuit->city}}</p>
				<p class="card-text pl-4"><i class="fas fa-lg fa-stopwatch"></i> {{$circuit->duration}}</p>
				@if($circuit->caretaker == 1)
				<p class="card-text pl-4"><i class="fas fa-lg fa-eye"></i> Circuito caretaker</p>
				<div class="text-center p-2">
					<a href="{{route('games.startCaretaker',['id'=>$circuit->id])}}"><button class="btn btn-primary">Guiar partida</button></a>
				</div>
				@endif
				<div class="text-center">
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#c_info_{{$circuit->id}}">
						Info
					</button>
				</div>
			</div>
			<div class="modal" id="c_info_{{$circuit->id}}">
				<div class="modal-dialog">
					<div class="modal-content">

						<!-- Modal Header -->
						<div class="modal-header">
							<h4 class="modal-title">{{$circuit->name}}</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>

						<!-- Modal body -->
						<div class="modal-body">
							<p>{{$circuit->description}}</p>
							<p>Location: {{$circuit->city}}</p>
							<p>Estimated time: {{$circuit->duration}}</p>
							<p>Difficulty: {{$circuit->difficulty}}</p>
							<p>Created by: {{$circuit->user->username}}</p>

							@if($circuit->caretaker === 1)
							<p>With caretaker</p>
							@endif
						</div>

						<!-- Modal footer -->
						
						<div class="modal-footer">
							<!--Edit button-->
							<a href="{{route('circuit.edit',['id'=>$circuit->id])}}"><button type="button" class="btn btn-secondary" >Edit</button></a>
							<!-- Delete  circuit button-->
							<form method="post" action="{{route('circuit.destroy',['id'=>$circuit->id])}}">
								@method('DELETE') 
								@csrf
								<button type="submit" class="btn btn-secondary" >Delete</button>
							</form>
							<!--Start as caretaker button-->
							@if($circuit->caretaker === 1)
							<a href="{{route('circuit.show',['id'=>$circuit->id])}}"><button type="button" class="btn btn-danger" >Start!</button></a>
							@endif
						</div>
						

					</div>
					

				</div>
			</div>
		</div>
		@endif
		@endforeach
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