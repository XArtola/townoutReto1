//Validación comentarios de opinión fin del juego
$(document).ready(function(){

	$('#comment_send').click(function(){
		let comment = $('textarea[name="comment"]').val();
		let correct = true;

		if(!comment){
			correct = false;
			$('.error[data-for="comment').text(dicc["require"][$('html').attr("lang")]);
		}

		else{
			if(!comment.match(/^[A-Za-z0-9ñÑáéíóúüçÁÉÍÓÚÜÇ\s$€.()@?¿!¡'+\-"&]+$/i)){
				correct = false;
				$('.error[data-for="comment"]').text(dicc["invalid_text"][$('html').attr("lang")]);
				
			}else {
				$('.error[data-for="comment"]').empty();
			}

		} 

		$('form').submit(function(e){
			if (correct == false){
				e.preventDefault();
			}else{
				this.submit();
			}
		});

		
	});
});