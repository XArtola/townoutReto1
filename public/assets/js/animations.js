

$(document).ready(function(){

	$('#logo').click(function(){
		$('html, body').animate(
			{scrollTop:0},1000
		);
	});

	// aparecen los placemarks al cargar la página
	$('#pm0').delay(500).fadeIn(500, function(){
		$('#pm1').delay(500).fadeIn(500, function(){
			$('#pm2').delay(1000).fadeIn(400, function(){
				$('#pm3').delay(500).fadeIn(400)
			})
		})
	});

	// animación scrolling al movernos con links dentro de una misma página
	$('.same-page-nav').click(function(){
		let href = $(this).attr('href');
		$('html, body').animate(
			{scrollTop:($(href).offset().top)},1000
		);
	});

	let menuShown = false;
	$('#menuToggle').click(function(){
		if(menuShown){
			$('nav ul').fadeOut(200);
			$('#menuToggle').attr('src','/assets/img/icons/menu.svg');
			$('#arrow_down').hide();
		}else{
			$('nav ul').css('display','flex');
			$('#menuToggle').attr('src','/assets/img/icons/cancel.svg');
			$('#arrow_down').fadeIn(50);
		}

		menuShown = !menuShown;
	});
	$('nav ul li *').click(function(){
		if(menuShown){
			$('nav ul').fadeOut(200);
			$('#menuToggle').attr('src','/img/icons/menu.svg');
			$('#arrow_down').hide();
			menuShown = !menuShown;
		}
	})

	const svg_original_pos = $('#logo img').offset().top;
	const mobile_original_pos = $('#mobile').offset().top;
	// aparece el contenido de la sección 1 al llegar a ella
	$(window).scroll(function(){
		if($(this).scrollTop() >= svg_original_pos){
			// fija el logo en la parte superior de la web
			$('#logo img').addClass('notscaledsvg',{duration:1000}).removeClass('scaledsvg');
		}else{
			// muestra el logo en su sitio original
			$('#logo img').addClass('scaledsvg',{duration:1000}).removeClass('notscaledsvg');
		}
		if($(this).scrollTop() >= mobile_original_pos){
			$('#mobile').css({'position':'fixed'});
		}else{
			$('#mobile').css({'position':'relative'});
		}

		if($(this).scrollTop() > $('html').offset().top){
			// oculta los placemarks del header
			$('.placemarks:not(#pm0)').fadeOut(1000);
			
		}else{
			// muestra los placemarks del header
			$('.placemarks:not(#pm0)').fadeIn(1000);
			
		}

		// cambia el color del placemark0 al llegar a la mitad del header(cuando se empieza a ver la sección1)
		if($(this).scrollTop() >= ($('#s1').offset().top/2) && $(this).scrollTop() <= ($('#s1').offset().top + ($('#s1').offset().top / 2))){
			$('#pm0 *').css('fill','#dedede');
			// cambia el enlace de la flecha para que vaya a la siguiente sección
			$('#arrow_down').attr('href','#s2');
		}else{
			$('#pm0 *').css('fill','#bd2830');
			// devuelve el enlace de la flecha a su estado original
			$('#arrow_down').attr('href','#s1');
		}

		// si está a la altura de la mitad de la sección 1, cambia el color del placemark0 por el que corresponde a la sección2
		if($(this).scrollTop() >= ($('#s1').offset().top + ($('#s1').offset().top / 2))){
			$('#pm0 *').css('fill','#076670');
			if($('#mobile').hasClass('mobile-right')) $('#mobile').removeClass('mobile-right');
			// cambia el enlace de la flecha para que vaya a la siguiente sección
			$('#arrow_down').attr('href','#s3');
		}

		if($(this).scrollTop() >= ($('#s2').offset().top + ($('#s2').height() / 4))){
			$('#pm0 *').css('fill','#076670');
			$('#mobile').addClass('mobile-right');
			// cambia el enlace de la flecha para que vaya a la siguiente sección
			$('#arrow_down').attr('href','#contacto');
		}

		if($(this).scrollTop() >= ($('#s3').offset().top + ($('#s3').height() / 2))){
			$('#arrow_down').css({'transform':'rotate(180deg)'});
			$('#arrow_down').attr('href','#header');
		}else{
			$('#arrow_down').css({'transform':'rotate(0)'});
		}

		// muestra u oculta el contenido de la sección
		if($(this).scrollTop() >= ($('#s1').offset().top - 300) && $(this).scrollTop() <= ($('#s1').offset().top + ($('#s1').offset().top / 3))){
			$('#s1 > *').stop().fadeIn(1000);
		}else{
			$('#s1 > *').stop().fadeOut(1000);
		}
	});
	$('#loader-content').css('display','none');
	$('.loading').removeClass('loading');
});

