//Creacion y edición de circuito. 
$(document).ready(function(){
	console.log('prest')
	$('#circuit_create, #circuit_edit').click(function(){
		let name = $('#inputs input[name="name"]').val();
		let description = $('#inputs textarea[name="description"]').val();
		let city = $('#inputs input[name="city"]').val();
		let difficulty = $('#inputs select[name="difficulty"]').val();
		let duration = parseInt($('#inputs input[name="duration"]').val());

		console.log(city);

		let correct = true;

		if(!name){
			correct = false;
			$('.error[data-for="c_name"]').text('Este campo es obligatorio');
		}else{
			if(!name.match(/^[A-Za-z0-9ñÑáéíóúÁÉÍÓÚ\s]+$/i)){
				correct = false;
				$('.error[data-for="c_name"]').text('No se admiten números o símbolos.');
			}else $('.error[data-for="c_name"]').empty();
		}

		if(!description){
			correct = false;
			$('.error[data-for="c_description"]').text('Este campo es obligatorio');
		}else{
			if(!description.match(/^[A-Za-z0-9ñÑáéíóúÁÉÍÓÚ\s\W]+$/i)){
				correct = false;
				$('.error[data-for="c_description"]').text('No se admiten símbolos.');
			}else $('.error[data-for="c_description"]').empty();
		}

		if(!city){
			correct = false;
			$('.error[data-for="c_city"]').text('Este campo es obligatorio');
		}else{
			if(!city.match(/^[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+$/i)){
				correct = false;
				$('.error[data-for="c_city"]').text('No se admiten números o símbolos.');
			}else $('.error[data-for="c_city"]').empty();
		}

		if(!difficulty){
			correct = false;
			$('.error[data-for="c_difficulty"]').text('Este campo es obligatorio');
		}else{
			difficulty = difficulty.toLowerCase();
			if(difficulty.match('easy') || difficulty.match('medium') || difficulty.match('difficult')){
				$('.error[data-for="c_difficulty"]').empty();
			}else{
				correct = false;
				$('#c_difficulty').text('Valor no válido');
			}
		}

		if(!duration){
			correct = false;
			$('.error[data-for="c_duration"]').text('Este campo es obligatorio');
		}else{
			if(duration < 5 || duration > 360){
				correct = false;
				$('.error[data-for="c_duration"]').text('Valor no válido');
			}else $('.error[data-for="c_duration"]').empty();
		}

		if(correct) $('#inputs').submit();
	});

});
