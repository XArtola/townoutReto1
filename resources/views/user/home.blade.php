@extends('layouts.user')
@section('title','Index')
@section('content')
<div id="all_circuits" class="p-1">

	<div class="row bg-warning my-4">
		<h1 class="text-light text-uppercase lead col-12 font-weight-bold p-2 mx-4">Circuitos disponibles</h1>

		@foreach($circuits as $circuit)
		@if($circuit->caretaker == 0)
		<div class="card my-2 mx-4" style="width: 18rem;" data-toggle="modal" data-target="#c_info">
			@isset($circuit->image)
			<!--	<img src="{{asset('/storage/circuits/'.$circuit->image)}}" class="card-img-top" alt="">-->
			<img src="{{$circuit->image}}" class="card-img-top" alt="">
			@else
			<img src="{{asset('assets/img/logoPNG.png')}}" class="card-img-top p-1" alt="">
			@endisset
			<div class="card-body">
				<h5 class="card-title text-uppercase font-weight-bold col-12 mx-auto text-center">{{$circuit->name}}</h5>
				<p class="card-text pl-4"><i class="fas fa-lg fa-globe-europe" style="color:#f9be2f;"></i> {{$circuit->city}}</p>
				<p class="card-text pl-4"><i class="fas fa-lg fa-stopwatch" style="color:#e94936;"></i> {{$circuit->duration}}</p>

				<div class="row py-2 text-center mx-auto">
					<h4><i class="fas fa-thumbs-up fa-1x col-3 mx-auto" style="color:grey"></i> <span class="col-3 mx-auto">{{$circuit->games->where('rating',1)->count()}}</span></h4>
					<h4><i class="fas fa-thumbs-down fa-1x col-3 mx-auto" style="color:grey"></i><span class="col-3 mx-auto">{{$circuit->games->where('rating',-1)->count()}}</span></h4>
				</div>

				<div class="text-center">
					<!--	<a href="{{route('games.newGame',$circuit->id)}}"><button class="btn btn-primary">Jugar</button></a>-->
					<!-- The Modal -->
					<div class="modal" id="c_info">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">

								<!-- Modal Header -->
								<div class="modal-header ">
									<h4 class="modal-title text-uppercase col-11 mx-auto text-center">{{$circuit->name}}</h4>
									<button type="button" class="close" data-dismiss="c_info">&times;</button>
								</div>

								<!-- Modal body -->
								<div class="modal-body">
									<div class="row">
										<div class="col-6">
											<p class="mx-auto pt-4 text-justify pl-2">{{$circuit->description}}</p>
											<p>Created by: {{$circuit->user->username}}</p>
										</div>
										<div class="col-6 pt-4">
											<p>Stages: {{$circuit->stages->count()}}</p>
											@if($circuit->difficulty === "easy")
											<p>Difficulty: <i class="far fa-compass fa-2x"></i></p>
											@elseif($circuit->difficulty === "medium")
											<p>Difficulty: <i class="far fa-compass fa-2x"></i> <i class="far fa-compass fa-2x"></i></p>
											@elseif($circuit->difficulty === "difficult")
											<p>Difficulty: <i class="far fa-compass fa-2x"></i> <i class="far fa-compass fa-2x"></i> <i class="far fa-compass fa-2x"></i></p>
											@endif
										</div>
									</div>
								</div>

								<!-- Modal footer -->
								<div class="modal-footer">
									<a href="{{route('games.newGame',$circuit->id)}}"><button class="btn btn-primary">Jugar</button></a>
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
		<div class="card my-2 mx-4" style="width: 18rem;" data-toggle="modal" data-target="#c_info_{{$circuit->id}}">
			@isset($circuit->image)
			<!--	<img src="{{asset('/storage/circuits/'.$circuit->image)}}" class="card-img-top" alt="">-->
			<img src="{{$circuit->image}}" class="card-img-top" alt="">

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

			</div>
			<!--Modal-->
			<div class="modal" id="c_info_{{$circuit->id}}">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">

						<!-- Modal Header -->
						<div class="modal-header ">
							<h4 class="modal-title text-uppercase col-11 mx-auto text-center">{{$circuit->name}}</h4>
							<button type="button" class="close" data-dismiss="#c_info_{{$circuit->id}}">&times;</button>
						</div>

						<!-- Modal body -->
						<div class="modal-body">
							<div class="row">
								<div class="col-6">
									<p class="mx-auto pt-4 text-justify pl-2">{{$circuit->description}}</p>
									<p class="text-center">Created by: {{$circuit->user->username}}</p>
								</div>
								<div class="col-6 pt-4 text-center">
									<p>Stages: {{$circuit->stages->count()}}</p>
									@if($circuit->difficulty === "easy")
									<p>Difficulty: <i class="far fa-compass fa-2x"></i></p>
									@elseif($circuit->difficulty === "medium")
									<p>Difficulty: <i class="far fa-compass fa-2x"></i> <i class="far fa-compass fa-2x"></i></p>
									@elseif($circuit->difficulty === "difficult")
									<p>Difficulty: <i class="far fa-compass fa-2x"></i> <i class="far fa-compass fa-2x"></i> <i class="far fa-compass fa-2x"></i></p>
									@endif
								</div>
							</div>
						</div>
						<!-- Modal footer -->

						<div class="modal-footer">
							<!--Edit button-->
							<a href="{{route('circuit.edit',['id'=>$circuit->id])}}"><button type="submit" class="btn btn-primary">Edit</button></a>
							<!-- Delete  circuit button-->
							<form method="post" action="{{route('circuit.destroy',['id'=>$circuit->id])}}">
								@method('DELETE')
								@csrf
								<button type="submit" class="btn btn-primary">Delete</button>
							</form>
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