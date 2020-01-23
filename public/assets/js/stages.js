let lang = document.getElementsByTagName("html")[0].getAttribute("lang");
		console.log(lang)
$('form').hide();
$('#' + $('#selector').val() + 'Form').show();
$(function() {

	$('#selector').change(function(event) {
		$('form').hide();
		$('#' + $('#selector').val() + 'Form').show();
	});

	// validación formulario de prueba tipo texto
	$('#submitText').click(function() {
		let question = $('#textForm input[name="question_text"]').val();
		let answer = $('#textForm input[name="answer"]').val();
		let correct = true;

		if (!question) {
			correct = false;
			$('#textForm .error[data-for="question_text"]').text(dicc["require"][$('html').attr("lang")]);
		} else {
			if (!question.match(/^[a-zñÑáéíóúÁÉÍÓÚ\s0-9?¿]+$/i)) {
				correct = false;
				$('#textForm .error[data-for="question_text"]').text('No se admiten símbolos.');
			} else $('#textForm .error[data-for="question_text"]').empty();
		}

		if (!answer) {
			correct = false;
			$('#textForm .error[data-for="answer"]').text(dicc["require"][$('html').attr("lang")]);
		} else {
			if (!answer.match(/^[a-zñÑáéíóúÁÉÍÓÚ\s0-9]+$/i)) {
				correct = false;
				$('#textForm .error[data-for="answer"]').text('No se admiten símbolos.');
			} else $('#textForm .error[data-for="answer"]').empty();
		}

		if (correct) $('#textForm').submit();
	});

	// validación formulario de prueba tipo quiz
	$('#submitQuiz').click(function() {
		let question = $('#quizForm input[name="question_text"]').val();
		let answer = $('#quizForm input[name="correct_ans"]').val();
		let pos1 = $('#quizForm input[name="possible_ans1"]').val();
		let pos2 = $('#quizForm input[name="possible_ans2"]').val();
		let pos3 = $('#quizForm input[name="possible_ans3"]').val();

		let correct = true;

		if (!question) {
			correct = false;
			$('#quizForm .error[data-for="question_text"]').text(dicc["require"][$('html').attr("lang")]);
		} else {
			if (!question.match(/^[a-zñÑáéíóúÁÉÍÓÚ\s0-9?¿]+$/i)) {
				correct = false;
				$('#quizForm .error[data-for="question_text"]').text(dicc["not_symbols"][$('html').attr("lang")]);
			} else $('#quizForm .error[data-for="question_text"]').empty();
		}

		if (!answer) {
			correct = false;
			$('#quizForm .error[data-for="correct_ans"]').text(dicc["require"][$('html').attr("lang")]);
		} else {
			if (!answer.match(/^[a-zñÑáéíóúÁÉÍÓÚ\s0-9]+$/i)) {
				correct = false;
				$('#quizForm .error[data-for="correct_ans"]').text(dicc["not_symbols"][$('html').attr("lang")]);
			} else $('#quizForm .error[data-for="correct_ans"]').empty();
		}

		if (!pos1) {
			correct = false;
			$('#quizForm .error[data-for="possible_ans1"]').text(dicc["require"][$('html').attr("lang")]);
		} else {
			if (!pos1.match(/^[a-zñÑáéíóúÁÉÍÓÚ\s0-9]+$/i)) {
				correct = false;
				$('#quizForm .error[data-for="possible_ans1"]').text(dicc["not_symbols"][$('html').attr("lang")]);
			} else $('#quizForm .error[data-for="possible_ans1"]').empty();
		}

		if (!pos2) {
			correct = false;
			$('#quizForm .error[data-for="possible_ans2"]').text(dicc["require"][$('html').attr("lang")]);
		} else {
			if (!pos2.match(/^[a-zñÑáéíóúÁÉÍÓÚ\s0-9]+$/i)) {
				correct = false;
				$('#quizForm .error[data-for="possible_ans2"]').text(dicc["not_symbols"][$('html').attr("lang")]);
			} else $('#quizForm .error[data-for="possible_ans2"]').empty();
		}

		if (!pos3) {} else {
			if (!pos3.match(/^[a-zñÑáéíóúÁÉÍÓÚ\s0-9]+$/i)) {
				correct = false;
				$('#quizForm .error[data-for="possible_ans3"]').text(dicc["not_symbols"][$('html').attr("lang")]);
			} else $('#quizForm .error[data-for="possible_ans3"]').empty();
		}


		if (correct) $('#quizForm').submit();
	});

	// validación formulario de prueba tipo img
	$('#submitImg').click(function() {
		let question = $('#imgForm input[name="question_text"]').val();

		let correct = true;

		if (!question) {
			correct = false;
			$('#imgForm .error[data-for="question_text"]').text(dicc["require"][$('html').attr("lang")]);
		} else {
			if (!question.match(/^[a-zñÑáéíóúÁÉÍÓÚ\s0-9?¿]+$/i)) {
				correct = false;
				$('#imgForm .error[data-for="question_text"]').text(dicc["not_symbols"][$('html').attr("lang")]);
			} else $('#imgForm .error[data-for="question_text"]').empty();
		}

		if (correct) $('#imgForm').submit();
	});

});