@extends('layouts.user')
@section('title','Index')
@section('content')
<div id="all_circuits" class="circuit-container">
	@if(Auth::user()->games()->whereNotNull('start_date')->whereNull('finish_date')->first()!=null)
	<div class="col-12">
		<a class="btn btn-success" href="{{route('games.play',['id'=>Auth::user()->games()->whereNotNull('start_date')->whereNull('finish_date')->first()->id])}}">Reanudar partida</a>
		<a class="btn btn-danger" href="{{route('games.exit',['game'=>Auth::user()->games()->whereNotNull('start_date')->whereNull('finish_date')->first()->id])}}">Terminar partida</a>
	</div>
	@endif
	<h1 class="text-break display-4 text-uppercase lead col-12 p-2">@lang('user.dispo_circuits')</h1>
	<div id="circuits">
		@foreach($circuits as $circuit)
		@if($circuit->caretaker == 0)
		<div class="card my-2 mx-4" style="width: 18rem;" data-toggle="modal" data-target="#c_info_{{$circuit->id}}">
			<div class="card-header">
				<div class="card-image">
					@isset($circuit->image)
					<!--	<img src="{{asset('/storage/circuits/'.$circuit->image)}}" class="card-img-top" alt="">-->
					<img src="{{$circuit->image}}" class="card-img-top" alt="">
					@else
					<img src="{{asset('assets/img/compressed-logo.svg',\App::environment() == 'production')}}" class="card-img-top default" alt="">
					@endisset
				</div>
			</div>
			<div class="card-body">
				<h5 class="card-title text-uppercase font-weight-bold col-12 mx-auto text-center circuitName">{{$circuit->name}}</h5>
				<p class="card-text pl-4"><i class="fas fa-lg fa-globe-europe"></i> {{$circuit->city}}</p>
				<p class="card-text pl-4"><i class="fas fa-lg fa-stopwatch"></i> {{$circuit->duration}}</p>

				<div class="row py-2 text-center mx-auto">
					<h4><i class="fas fa-thumbs-up fa-1x col-3 mx-auto" style="color:grey"></i> <span class="col-3 mx-auto">{{$circuit->games->where('rating',1)->count()}}</span></h4>
					<h4><i class="fas fa-thumbs-down fa-1x col-3 mx-auto" style="color:grey"></i><span class="col-3 mx-auto">{{$circuit->games->where('rating',-1)->count()}}</span></h4>


					<div class="text-center">
						<!--	<a href="{{route('games.newGame',$circuit->id)}}"><button class="btn btn-primary">Jugar</button></a>-->
						<!-- The Modal -->
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
												<p>@lang('user.created'): {{$circuit->user->username}}</p>
											</div>
											<div class="col-6 pt-4">
												<p><i class="fas fa-map-marked-alt fa-2x"></i> {{$circuit->stages->count()}}</p>
												@if($circuit->difficulty === "easy")
												<p>@lang('circuits.difficulty'): <i class="far fa-compass fa-2x"></i></p>
												@elseif($circuit->difficulty === "medium")
												<p>@lang('circuits.difficulty'): <i class="far fa-compass fa-2x"></i> <i class="far fa-compass fa-2x"></i></p>
												@elseif($circuit->difficulty === "difficult")
												<p>@lang('circuits.difficulty'): <i class="far fa-compass fa-2x"></i> <i class="far fa-compass fa-2x"></i> <i class="far fa-compass fa-2x"></i></p>
												@endif
											</div>
											@if($circuit->comments->count() > 0)
											<h1 class="ml-3 pl-2 pt-2 text-uppercase lead">@lang('user.comments')</h1>
											<table class="table-borderless col-10 mx-auto">
												@foreach($circuit->comments as $comment)
												<tr class="border-bottom">
													<td>
														<div class="row">
															<div class="font-weight-bold text-uppercase col-12 text-left">{{$comment->user->username}}</div>
															<div class="col-12 text-left">{{ date_create($comment->created_at)->format('Y-m-d')}}</div>
														</div>
													</td>
													<td class="text-justify">{{$comment->comment}}</td>
												</tr>
												@endforeach
											</table>

											@endif
											<div>

											</div>
										</div>
									</div>
									<!-- Modal footer -->
									<div class="modal-footer">
										<a href="{{route('games.newGame',$circuit->id)}}"><button class="btn btn-primary">@lang('circuits.play')</button></a>
									</div>
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

<div id="my_circuits" class="circuit-container">
	<h1 class="text-break display-4 text-uppercase lead col-12 p-2">@lang('user.my_circuits')</h1>
	<div>
		@foreach($circuits as $circuit)
		@if(Auth::user()->id==$circuit->user->id)
		<div class="card my-2 mx-4" style="width: 18rem;" data-toggle="modal" data-target="#c{{$circuit->id}}_info">
			<div class="card-header">
				<div class="card-image">
					@isset($circuit->image)
					<img src="{{$circuit->image}}" class="card-img-top" alt="">
					@else
					<img src="{{asset('assets/img/compressed-logo.svg',\App::environment() == 'production')}}" class="card-img-top default" alt="">
					@endisset
				</div>
			</div>
			<div class="card-body">
				<h5 class="card-title text-uppercase font-weight-bold circuitName">{{$circuit->name}}</h5>
				<p class="card-text pl-4"><i class="fas fa-lg fa-globe-europe"></i> {{$circuit->city}}</p>
				<p class="card-text pl-4"><i class="fas fa-lg fa-stopwatch"></i> {{$circuit->duration}}</p>
				@if($circuit->caretaker == 1)
				<p class="card-text pl-4"><i class="fas fa-lg fa-eye"></i> @lang('user.caretaker_circuit')</p>
				<div class="text-center p-2">
					@if($circuit->join_code != 'START')
					<a href="{{route('games.startCaretaker',['id'=>$circuit->id])}}"><button class="btn btn-primary">@lang('user.guide_game')</button></a>
					@else
					<a href="{{route('games.monitor',['circuit'=>$circuit->id])}}"><button class="btn btn-primary">@lang('user.guide_game')</button></a>
					@endif
				</div>
				@endif

			</div>
			<!--Modal-->
			<div class="modal" id="c{{$circuit->id}}_info">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">

						<!-- Modal Header -->
						<div class="modal-header ">
							<h4 class="modal-title text-uppercase col-11 mx-auto text-center">{{$circuit->name}}</h4>
							<button type="button" class="close" data-dismiss="#c{{$circuit->id}}_info">&times;</button>
						</div>

						<!-- Modal body -->
						<div class="modal-body">
							<div class="row">
								<div class="col-6">
									<p class="mx-auto pt-4 text-justify pl-2">{{$circuit->description}}</p>
									<p class="text-center">@lang('user.created'): {{$circuit->user->username}}</p>
								</div>
								<div class="col-6 pt-4 text-center">
									<p>@lang('stages.stages'): {{$circuit->stages->count()}}</p>
									@if($circuit->difficulty === "easy")
									<p>@lang('circuits.difficulty'): <i class="far fa-compass fa-2x"></i></p>
									@elseif($circuit->difficulty === "medium")
									<p>@lang('circuits.difficulty'): <i class="far fa-compass fa-2x"></i> <i class="far fa-compass fa-2x"></i></p>
									@elseif($circuit->difficulty === "difficult")
									<p>@lang('circuits.difficulty'): <i class="far fa-compass fa-2x"></i> <i class="far fa-compass fa-2x"></i> <i class="far fa-compass fa-2x"></i></p>
									@endif
								</div>
							</div>
						</div>
						<!-- Modal footer -->

						<div class="modal-footer">
							<!--Edit button-->
							<a href="{{route('circuit.edit',['id'=>$circuit->id])}}"><button type="submit" class="btn btn-primary">@lang('circuits.edit_button')</button></a>
							<!-- Delete  circuit button-->
							<form method="post" action="{{route('circuit.destroy',['id'=>$circuit->id])}}">
								@method('DELETE')
								@csrf
								<button type="submit" class="btn btn-primary">@lang('circuits.delete_button')</button>
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