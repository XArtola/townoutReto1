@extends('layouts.user')
@section('title') @lang('circuits.order_stages') @endsection
@section('imports')
<script src="{{asset('/assets/js/circuits.js',\App::environment() == 'production')}}"></script>
@endsection
@section('content')
<input type="hidden" name="acces" id="acces" value="{{Auth()->user()->api_token}}">
<div id="order-container">
	<h2 class="display-4 order-title">{{$circuit->name}}</h2>
	<div id="stages">
		<!-- Se genera por JQuery -->
	</div>
	<button type="button" id="send">Send</button>
</div>
<script>
	$(document).ready(function() {

		// @ json convierte el array de laravel en json de js
		let stages = @json($circuit->stages);

		let arrow_down = "{{asset('/assets/img/icons/arrow_down.svg',\App::environment() == 'production')}}";
		let arrow_up = "{{asset('/assets/img/icons/arrow_down.svg',\App::environment() == 'production')}}";

		let renderResults = () => {
			$('#stages').empty();
			for (i in stages) {
				$('#stages').append(`
						<div class="stage row" data-order="${stages[i].order}" data-stageid="${stages[i].id}">
							<h2 style="font-size: 24px;">${stages[i].question_text}</h2>
							<div class="order-buttons">
								<img src="${arrow_down}" alt="arrow_down" class="arrow_down">
								<img src="${arrow_up}" alt="arrow_up" style="transform: rotate(180deg);" class="arrow_up">
							</div>
						</div>
					`);
			}
			$('.stage[data-order="'+stages[0].order+'"]').find('.arrow_up').hide();
			$('.stage[data-order="'+ stages.length +'"]').find('.arrow_down').hide();
		}

		// ordena el array y llama a renderResults
		let sortResults = () => {
			stages.sort(function(a, b) {
				return (a.order > b.order) ? 1 : ((a.order < b.order) ? -1 : 0);
			});
			renderResults();
		}

		sortResults()

		$('#stages').on('click','.arrow_up',function(){
			// posición del elemento clicado
			let position = parseInt($(this).parent().parent().data('order') - 1);

			// cambia el orden en el array
			let aux = stages[position].order;
			stages[position].order = stages[position - 1].order;
			stages[position - 1].order = aux;
			sortResults();
		});

		$('#stages').on('click','.arrow_down',function(){
			// posición del elemento clicado
			let position = parseInt($(this).parent().parent().data('order') - 1);

			// cambia el orden en el array
			let aux = stages[position].order;
			stages[position].order = stages[position + 1].order;
			stages[position + 1].order = aux;
			sortResults();
		});

		$('#send').click(function() {
			$('.stage').each(function() {
				$.ajax({
					url: base_url + 'api/stages/' + $(this).data('stageid') + '/order',
					method: 'PUT',
					data: {
						order: parseInt($(this).data('order'))
					},
					crossDomain: true,
					headers: {
						'Authorization': `Bearer ` + $('#acces').val(),
					},
					success: function(response) {
						window.history.back();
					},
					error: function(error) {
						console.error(error.status + ' - ' + error.statusText)
					}
				});
			});
		});

	});
</script>

@endsection