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
		<option value="text">Text</option>
		<option value="quiz">Quiz</option>
		<option value="img">Img</option>
	</select>

	<form id="textForm" method="POST" action="{{route('stages.store')}}">
		@csrf
		<div class="form-group">
			<label>Question text</label>
			<input type="text" name="question_text">
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
			<input type="text" name="answer">
		</div>
		<div class="form-group">
			<input type="submit">
		</div>
	</form>
	<form id="quizForm" method="POST" action="{{route('stages.store')}}">
		@csrf
		<div class="form-group">

			<label>Question text</label>
			<input type="text" name="question_text">
		</div>
		<div class="form-group">
			<label>Question image</label>
			<input type="file" name="question_image">
		</div>
		<input type="hidden" name="lat">
		<input type="hidden" name="lng">
		<input type="hidden" name="order">
		<input type="hidden" name="circuit_id">
		<input type="hidden" name="stage_type" value="quiz">
		<div class="form-group">
			<label>Correct answer</label>
			<input type="text" name="correct_ans">
		</div>
		<div class="form-group">
			<label>Possible answer 1</label>
			<input type="text" name="possible_ans1">
		</div>
		<div class="form-group">
			<label>Possible answer 2</label>
			<input type="text" name="possible_ans2">
		</div>
		<div class="form-group">
			<label>Possible answer 3</label>
			<input type="text" name="possible_ans3">
		</div>
		<input type="submit">
	</form>

	<script type="text/javascript">
		$('form').hide();
		$('#textForm').show();
		$(function() {

			$('#selector').change(function(event) {
				$('form').hide();
				console.log('#' + $('#selector').val() + 'Form')
				$('#' + $('#selector').val() + 'Form').show();
			});
		});
	</script>
</body>

</html>