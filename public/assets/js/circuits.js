//Creacion y edición de circuito. 
$(document).ready(function(){
	$('#caretaker').click(function(){
		$('.error[data-for="c_caretaker"]').text('No se puedes modificar esta opción una vez creado el circuito.');
		
	})
	
	$('#circuit_create, #circuit_edit').click(function(){
		let name = $('#inputs input[name="name"]').val();
		let description = $('#inputs textarea[name="description"]').val();
		let city = $('#inputs input[name="city"]').val();
		let difficulty = $('#inputs select[name="difficulty"]').val();
		let duration = parseInt($('#inputs input[name="duration"]').val());
		let correct = true;

		if(!name){
			correct = false;
			$('.error[data-for="c_name"]').text(dicc["require"][$('html').attr("lang")]);
		}else{
			if(!name.match(/^[A-Za-z0-9ñÑáéíóúÁÉÍÓÚ\s]+$/i)){
				correct = false;
				$('.error[data-for="c_name"]').text(dicc["error"][$('html').attr("lang")]);
			}else $('.error[data-for="c_name"]').empty();
		}

		if(!description){
			correct = false;
			$('.error[data-for="c_description"]').text(dicc["require"][$('html').attr("lang")]);
		}else{
			if(!description.match(/^[A-Za-z0-9ñÑáéíóúÁÉÍÓÚ\s\W]+$/i)){
				correct = false;
				$('.error[data-for="c_description"]').text(dicc["error"][$('html').attr("lang")]);
			}else $('.error[data-for="c_description"]').empty();
		}

		if(!city){
			correct = false;
			$('.error[data-for="c_city"]').text(dicc["require"][$('html').attr("lang")]);
		}else{
			if(!city.match(/^[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+$/i)){
				correct = false;
				$('.error[data-for="c_city"]').text(dicc["error"][$('html').attr("lang")]);
			}else $('.error[data-for="c_city"]').empty();
		}

		if(!difficulty){
			correct = false;
			$('.error[data-for="c_difficulty"]').text(dicc["require"][$('html').attr("lang")]);
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
			$('.error[data-for="c_duration"]').text(dicc["require"][$('html').attr("lang")]);
		}else{
			if(duration < 5 || duration > 360){
				correct = false;
				$('.error[data-for="c_duration"]').text(dicc["error_difficulty"][$('html').attr("lang")]);
			}else $('.error[data-for="c_duration"]').empty();
		}

		if(correct) $('#inputs').submit();
	});

});
