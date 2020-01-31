$(function () {

	$('#hiddenDiv').css('min-height', $('#nav').css('height'));

	$(window).on('resize', function () {

		$('#hiddenDiv').css('min-height', $('#nav').css('height'));

	});
});