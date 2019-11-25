$(document).ready(function(){


	// comprobaciones formulario de contacto
	$('#send').click(function(){
		let nombre = $('#inputs input[name="nombre"]').val();
		let email = $('#inputs input[name="email"]').val();
		let mensaje = $('#inputs textarea[name="mensaje"]').val();

		if(!nombre)
			$('.error[data-for="nombre"]').text('Este campo es obligatorio');
		if(!email)
			$('.error[data-for="email"]').text('Este campo es obligatorio');
		if(!mensaje)
			$('.error[data-for="mensaje"]').text('Este campo es obligatorio');

		if(nombre && email && mensaje){
			let correct = true;
			if(!nombre.match(/^[A-Za-z]+/)){
				correct = false;
				$('.error[data-for="nombre"]').text('No se admiten números o símbolos.');
			}else $('.error[data-for="nombre"]').empty();
			
			if(!email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)){
				correct = false;
				$('.error[data-for="nombre"]').text('Formato inválido para un correo electrónico.');
			}else $('.error[data-for="email"]').empty();

			if(correct) $('#contacto-form').submit();
		}
	});
});