$(document).ready(function(){

	// aparecen los placemarks al cargar la página
	$('#pm1').delay(500).fadeIn(500, function(){
		$('#pm2').delay(1000).fadeIn(400, function(){
			$('#pm3').delay(500).fadeIn(400)
		})
	});

	// animación scrolling al movernos con links dentro de una misma página
	$('.same-page-nav').click(function(){
		let href = $(this).attr('href');
		$('html, body').animate(
			{scrollTop:($(href).offset().top)},1000
		);
	});

	// aparece el contenido de la sección 1 al llegar a ella
	$(window).scroll(function(){
		if($(this).scrollTop() > $('html').offset().top){
			$('.placemarks').fadeOut(1000);
		}

		if($(this).scrollTop() >= ($('#s1').offset().top)){
			$('#s1 > *').stop().fadeIn(1000);
		}else{
			$('#s1 > *').stop().fadeOut(1000);
		}
	});

});