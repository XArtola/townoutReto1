//Validación comentarios de opinión fin del circuito
$(document).ready(function(){
	console.log('funciona')
	$('#comment_send').click(function(){
		let comment = $('textarea[name="comment"]').val();
		console.log(comment);

		let correct = true;
		if(!comment){
			console.log(comment);
			correct=false;
			$('.error[data-for="comment').text('Este apartado está vacío')
		}

		else{
			if(!comment.match(/^[A-Za-z0-9ñÑáéíóúüçÁÉÍÓÚÜÇ\s$€.()@?¿!¡'+\-"&]+$/i)){
				correct = false;
				$('.error[data-for="comment"]').text('Formato inválido.');
			}else {
				//console.log('sin error');
				$('.error[data-for="comment"]').empty();

			}

		} 

		if(correct) $('#comment').submit();
		console.log('mete datos');
	});
});