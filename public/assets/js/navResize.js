$(function () {

	// Al caragar la página y cuando se encuantra un cambio detamaño de ventana
	// añadir el alto del nav al div que se encuentra debajo  de este 
	// para cuadrar la página

	$('#hiddenDiv').css('min-height', $('#nav').css('height'));

	$(window).on('resize', function () {

		$('#hiddenDiv').css('min-height', $('#nav').css('height'));

	});
});