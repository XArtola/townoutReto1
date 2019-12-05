$(document).ready(function(){

	$('#avatar').click(function(){
		$('#image').click();
	});

	const email_sintax = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

	// validación formulario de contacto
	$('#contact_send').click(function(){
		let nombre = $('#inputs input[name="nombre"]').val();
		let apellido = $('#inputs input[name="apellido"]').val();
		let email = $('#inputs input[name="email"]').val();
		let mensaje = $('#inputs textarea[name="mensaje"]').val();

		if(!nombre)
			$('.error[data-for="nombre"]').text('Este campo es obligatorio');
		if(!apellido)
			$('.error[data-for="apellido"]').text('Este campo es obligatorio');
		if(!email)
			$('.error[data-for="email"]').text('Este campo es obligatorio');
		if(!mensaje)
			$('.error[data-for="mensaje"]').text('Este campo es obligatorio');

		if(nombre && apellido && email && mensaje){
			let correct = true;
			if(!nombre.match(/^[a-zñÑáéíóúÁÉÍÓÚ\s]+$/i)){
				correct = false;
				$('.error[data-for="nombre"]').text('No se admiten números o símbolos.');
			}else $('.error[data-for="nombre"]').empty();

			if(!apellido.match(/^[a-zñÑáéíóúÁÉÍÓÚ\s]+$/i)){
				correct = false;
				$('.error[data-for="apellido"]').text('No se admiten números o símbolos.');
			}else $('.error[data-for="apellido"]').empty();
			
			if(!email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)){
				correct = false;
				$('.error[data-for="email"]').text('Formato inválido para un correo electrónico.');
			}else $('.error[data-for="email"]').empty();

			if(!mensaje.match(/^[a-z0-9ñÑáéíóúÁÉÍÓÚ\s,.:;-]+$/i)){
				correct = false;
				$('.error[data-for="mensaje"]').text('Formato de texto no aceptado.');
			}
			if(correct) $('#contacto-form').submit();
		}
	});

	//validación de registro de usuario
	$('#register_send').click(function(){
		let username = $('.register input[name="username"]').val();
		let name = $('.register input[name="name"]').val();
		let surname = $('.register input[name="surname"]').val();
		let email = $('.register input[name="email"]').val();
		let password = $('.register input[name="password"]').val();
		let password_confirmation = $('.register input[name="password_confirmation"]').val();

		let error = '@lang(\'validation.filled\')';

		if(!username)
			$('.error[data-for="regis_username"]').text('Debes introducir un nombre de usuario');
		if(!name)
			$('.error[data-for="regis_name"]').text('Debes introducir un nombre');
		if(!surname)
			$('.error[data-for="regis_surname"]').text('Debes introducir un apellido');
		if(!email)
			$('.error[data-for="regis_email"]').text('Debes introducir un email');
		if(!password)
			$('.error[data-for="regis_password"]').text('Debes introducir una contraseña');
		if(!password_confirmation)
			$('.error[data-for="regis_confirmpassword"]').text('Debes repetir la contraseña');

		if(username && name && surname && email && password && password_confirmation){
			let correct = true;
			
			if (!username.match(/^[a-zñÑáéíóúÁÉÍÓÚ0-9]+$/i)) {
				correct = false;
				$('.error[data-for="regis_username"]').text('El nombre de usuario solo puede contener letras y numeros sin espacios');
			}else $('.error[data-for="regis_username"]').empty();

			if(!name.match(/^[a-zñÑáéíóúÁÉÍÓÚ\s]+$/i)){
				correct = false;
				$('.error[data-for="regis_name"]').text('No se admiten números o símbolos.');
			}else $('.error[data-for="regis_name"]').empty();

			if(!surname.match(/^[a-zñÑáéíóúÁÉÍÓÚ\s]+$/i)){
				correct = false;
				$('.error[data-for="regis_surname"]').text('No se admiten números o símbolos.');
			}else $('.error[data-for="regis_surname"]').empty();
			
			if(!email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)){
				correct = false;
				$('.error[data-for="regis_email"]').text('Formato inválido para un correo electrónico.');
			}else $('.error[data-for="regis_email"]').empty();

			if(!password.match(/^[a-z0-9\s]{8,}$/i)){
				correct = false;
				$('.error[data-for="regis_password"]').text('La longitud mínima son 8 carácteres y solo puede contener letras y números');
			}else $('.error[data-for="regis_password"]').empty();
			
			if(!password_confirmation.match(password)){
				correct = false;
				$('.error[data-for="regis_confirmpassword"]').text('Repita contraseña');
			}else $('.error[data-for="regis_confirmpassword"]').empty();


			if(correct) $('#register_form').submit();
		}


	});



	
	//Validación de inicio de sesión

	$('#login_send').click(function(){
		let email = $('.login input[name="email"]').val();
		let password = $('.login input[name="password"]').val();


		if(!email)
			$('.error[data-for="login_email"]').text('Introduce email');
		if(!password)
			$('.error[data-for="login_password"]').text('Introduce la contraseña');


		if(email && password){
			let correct = true;
			
			if(!email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)){
				correct = false;
				$('.error[data-for="login_mail"]').text('Formato de correo electrónico inválido');
			}else $('.error[data-for="regis_username"]').empty();

			if(!password.match(/^[a-z0-9]{8,}$/)){
				correct = false;
				$('.error[data-for="login_password"]').text('Contraseña no válida');
			}else $('.error[data-for="login_password"]').empty();



			if(correct) $('#login_form').submit();
		}


	});

	//Validacion reset password
	$('#reset_send').click(function(){
		let email = $('.reset input[name="email"]').val();
		let password = $('.reset input[name="password"]').val();
		let confpassword = $('.reset input[name="password_confirmation"]').val();



		if(!email)
			$('.error[data-for="reset_email"]').text('Introduce email');
		if(!password)
			$('.error[data-for="reset_password"]').text('Introduce la contraseña');
		if(!confpassword)
			$('.error[data-for="reset_password_confirmation"]').text('Repite la contraseña');


		if(email && password && confpassword){
			let correct = true;
			
			if(!email.match(email_sintax)){
				correct = false;
				$('.error[data-for="reset_email"]').text('Formato de correo electrónico inválido');
			}else $('.error[data-for="reset_password"]').empty();

			if(!password.match(/^[a-z0-9]{8,}$/)){
				correct = false;
				$('.error[data-for="reset_password"]').text('Contraseña no válida');
			}else $('.error[data-for="reset_password"]').empty();

			if(!confpassword.match(password)){
				correct = false;
				$('.error[data-for="reset_password_confirmation"]').text('No cincide con la contraseña');
			}else $('.error[data-for="reset_password_confirmation"]').empty();

			if(correct) $('#reset_send').submit();
		}


	});

	//Validacion en pantallas create y update
	$('#submit_create, #submit_edit').click(function(){

		// guarda en una variable el nombre del formulario actual
		// si es "submit_create", se queda con la parte "create" para usarlo a la hora de llamar a "create_form"
		let current_form = $(this).attr('id').substring(7,$(this).attr('id').length);

		$('#'+current_form+'_form label').empty();


		// definición de valores
		let username = $('#'+current_form+'_form input[name="username"]').val();
		let name = $('#'+current_form+'_form input[name="name"]').val();
		let surname = $('#'+current_form+'_form input[name="surname"]').val();
		let email = $('#'+current_form+'_form input[name="email"]').val();


		// si esta variable sigue siendo true al final, se hará submit
		let correct = true;


		// comprueba si existen
		if(!email){
			correct=false;
			$('label[for="email"]').text('Introduce email');
		}else $('label[for="email"]').empty();
		if(!username){
			correct=false;
			$('label[for="username"]').text('Introduce un nombre de usuario');
		}else $('label[for="username"]').empty();
		if(!name){
			correct=false;
			$('label[for="name"]').text('Introduce un nombre');
		}else $('label[for="name"]').empty();
		if(!surname){
			correct=false;
			$('label[for="surname"]').text('Introduce un apellido');
		}else $('label[for="surname"]').empty();


		// comprueba la sintáxis		
		if(!email.match(email_sintax)){
			correct = false;
			$('label[for="email"]').text('Formato de correo electrónico inválido');
		}else $('label[for="email"]').empty();

		if(!username.match(/^[a-z0-9]+$/i)){
			correct = false;
			$('label[for="username"]').text('Nombre de usuario no válido');
		}else $('label[for="username"]').empty();

		if(!name.match(/^[a-z\s]+$/i)){
			correct = false;
			$('label[for="name"]').text('Un nombre no puede contener números o símbolos');
		}else $('label[for="name"]').empty();

		if(!surname.match(/^[a-z\s]+$/i)){
			correct = false;
			$('label[for="surname"]').text('Un apellido no puede contener números o símbolos');
		}else $('label[for="surname"]').empty();

		if(correct) $('#'+current_form+'_form').submit();


	});


});