$(document).ready(function(){

	$('#avatar').click(function(){
		$('#image').click();
	});

	const email_sintax = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

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

$('input#image').change(function(){
	$('.avatar').empty();
	console.log(`<img id='avatar' src='{{url('storage','avatars')}}/`+ $('input#image').val().match(/[A-Za-z0-9]+\.[A-Za-z0-9]+/)[0] +`'/>`);
});