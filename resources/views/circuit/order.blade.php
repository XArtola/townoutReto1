@extends('layouts.user')
@section('imports')
<script src="{{asset('/assets/js/circuits.js',\App::environment() == 'production')}}"></script>
@endsection
@section('content')
	<div id="stages">
		@foreach($circuit->stages as $stage)
			<div class="stage" data-order="{{$stage->order}}">
				<h2 style="font-size: 24px;">{{$stage->question_text}}</h2>
				<div class="order-buttons" data-stageid="{{$stage->id}}" >
					<img src="{{asset('/assets/img/icons/arrow_down.svg',\App::environment() == 'production')}}" alt="arrow_down" class="arrow_down">
					<img src="{{asset('/assets/img/icons/arrow_down.svg',\App::environment() == 'production')}}" alt="arrow_up" style="transform: rotate(180deg);" class="arrow_up">
				</div>
			</div>
		@endforeach
	</div>
	<script>
		$(document).ready(function(){

			$('.arrow_up').click(function(){
				let order = $(this).parent().parent().data('order');
				if(order > 1){
					$('.stage[data-order="'+ (order - 1) +'"]').attr('data-order', order)
					$(this).parent().parent().attr('data-order',(parseInt(order) - 1))

					console.log('el de arriba ahora es: '+$(this).parent().parent().attr('data-order'))
					console.log('el de abajo ahora es: '+$('.stage[data-order="'+ (order - 1) +'"]').attr('data-order'))

					$('#stages').append($('#stages .stage').sort(function(a,b){
					   return a.getAttribute('data-order')-b.getAttribute('data-order');
					}));

				}
			});

		});
	</script>

@endsection