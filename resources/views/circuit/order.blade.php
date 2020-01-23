@extends('layouts.user')
@section('imports')
<script src="{{asset('/assets/js/circuits.js',\App::environment() == 'production')}}"></script>
@endsection
@section('content')
	@foreach($circuit->stages as $stage)
		<div class="stage">
			<h2 style="font-size: 24px;">{{$stage->question_text}}</h2>
			<div class="order-buttons" data-stageid="{{$stage->id}}" data-order="{{$stage->order}}">
				<img src="{{asset('/assets/img/icons/arrow_down.svg',\App::environment() == 'production')}}" alt="arrow_up" class="arrow_up">
				<img src="{{asset('/assets/img/icons/arrow_down.svg',\App::environment() == 'production')}}" alt="arrow_down" style="transform: rotate(180deg);" class="arrow_down">
			</div>
		</div>
	@endforeach

	<script>
		$(document).ready(function(){

			$('.arrow_up').click(function(){
				if($(this).parent().attr('data-order') !== 0){

					let order =$(this).parent().attr('data-order');
					$('.order-buttons[data-order="'+ (order - 1) +'"]').attr('data-order', order)
					$(this).parent().attr('data-order', (order - 1));

				}
			});

		});
	</script>

@endsection