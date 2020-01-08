<!DOCTYPE html>
<html>

<head>
	<title>Forms</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>

<body>
	<select id="selector">
		<option value="text" selected>Text</option>
		<option value="quiz">Quiz</option>
		<option value="img">Img</option>
	</select>

	<form id="textForm" method="POST" action="{{route('stages.store')}}" enctype="multipart/form-data">
		@csrf
		<div class="form-group">
			<label>Question text</label>
			<input type="text" name="question_text" value={{old('question_text')}}>
			{!! $errors->first('question_text','<span>:message</span>')!!}
			<span class="error" data-for="question_text"></span>

		</div>
		<div class="form-group">
			<label>Question image</label>
			<input type="file" name="question_image">
		</div>
		<input type="hidden" name="lat" value="-2">
		<input type="hidden" name="lng" value="-3">
		<input type="hidden" name="order" value="1">
		<input type="hidden" name="circuit_id" value="1">
		<input type="hidden" name="stage_type" value="text">
		<div class="form-group">
			<label>Answer</label>
			<input type="text" name="answer" value={{old('answer')}}>
			{!! $errors->first('answer','<span>:message</span>')!!}
			<span class="error" data-for="answer"></span>

		</div>
		<div class="form-group">
			<button type="button" id="submitText">Submit</button>
		</div>
	</form>

	<form id="quizForm" method="POST" action="{{route('stages.store')}}" enctype="multipart/form-data">
		@csrf

		<div class="form-group">

			<label>Question text</label>
			<input type="text" name="question_text" value={{old('question_text')}}>
			{!! $errors->first('question_text','<span>:message</span>')!!}
			<span class="error" data-for="question_text"></span>

		</div>
		<div class="form-group">
			<label>Question image</label>
			<input type="file" name="question_image">
		</div>
		<input type="hidden" name="lat" value="-2">
		<input type="hidden" name="lng" value="-3">
		<input type="hidden" name="order" value="1">
		<input type="hidden" name="circuit_id" value="1">
		<input type="hidden" name="stage_type" value="quiz">
		<div class="form-group">
			<label>Correct answer</label>
			<input type="text" name="correct_ans" value={{old('correct_ans')}}>
			{!! $errors->first('correct_ans','<span>:message</span>')!!}
			<span class="error" data-for="correct_ans"></span>

		</div>
		<div class="form-group">
			<label>Possible answer 1</label>
			<input type="text" name="possible_ans1" value={{old('possible_ans1')}}>
			{!! $errors->first('possible_ans1','<span>:message</span>')!!}
			<span class="error" data-for="possible_ans1"></span>

		</div>
		<div class="form-group">
			<label>Possible answer 2</label>
			<input type="text" name="possible_ans2" value={{old('possible_ans2')}}>
			{!! $errors->first('possible_ans2','<span>:message</span>')!!}
			<span class="error" data-for="possible_ans2"></span>

		</div>
		<div class="form-group">
			<label>Possible answer 3</label>
			<input type="text" name="possible_ans3" value={{old('possible_ans3')}}>
			{!! $errors->first('possible_ans3','<span>:message</span>')!!}
			<span class="error" data-for="possible_ans3"></span>

		</div>
		<button type="button" id="submitQuiz">Submit</button>
	</form>

	<form id="imgForm" method="POST" action="{{route('stages.store')}}" enctype="multipart/form-data">
		@csrf
		<div class="form-group">
			<label>Question text</label>
			<input type="text" name="question_text" value={{old('question_text')}}>
			{!! $errors->first('question_text','<span>:message</span>')!!}
			<span class="error" data-for="question_text"></span>
		</div>
		<div class="form-group">
			<label>Question image</label>
			<input type="file" name="question_image">

		</div>
		<input type="hidden" name="lat" value="-2">
		<input type="hidden" name="lng" value="-3">
		<input type="hidden" name="order" value="1">
		<input type="hidden" name="circuit_id" value="1">
		<input type="hidden" name="stage_type" value="img">

		<div class="form-group">
			<button type="button" id="submitImg">Submit</button>
		</div>
	</form>

	<button type="button">Finish</button>

	<script type="text/javascript">
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
					$('#textForm .error[data-for="question_text"]').text('Este campo es obligatorio');
				} else {
					if (!question.match(/^[a-zñÑáéíóúÁÉÍÓÚ\s0-9?¿]+$/i)) {
						correct = false;
						$('#textForm .error[data-for="question_text"]').text('No se admiten símbolos.');
					} else $('#textForm .error[data-for="question_text"]').empty();
				}

				if (!answer) {
					correct = false;
					$('#textForm .error[data-for="answer"]').text('Este campo es obligatorio');
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
					$('#quizForm .error[data-for="question_text"]').text('Este campo es obligatorio');
				} else {
					if (!question.match(/^[a-zñÑáéíóúÁÉÍÓÚ\s0-9?¿]+$/i)) {
						correct = false;
						$('#quizForm .error[data-for="question_text"]').text('No se admiten símbolos.');
					} else $('#quizForm .error[data-for="question_text"]').empty();
				}

				if (!answer) {
					correct = false;
					$('#quizForm .error[data-for="correct_ans"]').text('Este campo es obligatorio');
				} else {
					if (!answer.match(/^[a-zñÑáéíóúÁÉÍÓÚ\s0-9]+$/i)) {
						correct = false;
						$('#quizForm .error[data-for="correct_ans"]').text('No se admiten símbolos.');
					} else $('#quizForm .error[data-for="correct_ans"]').empty();
				}

				if (!pos1) {
					correct = false;
					$('#quizForm .error[data-for="possible_ans1"]').text('Este campo es obligatorio');
				} else {
					if (!pos1.match(/^[a-zñÑáéíóúÁÉÍÓÚ\s0-9]+$/i)) {
						correct = false;
						$('#quizForm .error[data-for="possible_ans1"]').text('No se admiten símbolos.');
					} else $('#quizForm .error[data-for="possible_ans1"]').empty();
				}

				if (!pos2) {
					correct = false;
					$('#quizForm .error[data-for="possible_ans2"]').text('Este campo es obligatorio');
				} else {
					if (!pos2.match(/^[a-zñÑáéíóúÁÉÍÓÚ\s0-9]+$/i)) {
						correct = false;
						$('#quizForm .error[data-for="possible_ans2"]').text('No se admiten símbolos.');
					} else $('#quizForm .error[data-for="possible_ans2"]').empty();
				}

				if (!pos3) {} else {
					if (!pos3.match(/^[a-zñÑáéíóúÁÉÍÓÚ\s0-9]+$/i)) {
						correct = false;
						$('#quizForm .error[data-for="possible_ans3"]').text('No se admiten símbolos.');
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
					$('#imgForm .error[data-for="question_text"]').text('Este campo es obligatorio');
				} else {
					if (!question.match(/^[a-zñÑáéíóúÁÉÍÓÚ\s0-9?¿]+$/i)) {
						correct = false;
						$('#imgForm .error[data-for="question_text"]').text('No se admiten símbolos.');
					} else $('#imgForm .error[data-for="question_text"]').empty();
				}

				if (correct) $('#imgForm').submit();
			});

		});
	</script>
</body>

</html>