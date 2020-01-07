<!DOCTYPE html>
<html>

<head>
	<title>Forms</title>
	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>

</head>

<body>
	<select id="selector">
		<option value="text">Text</option>
		<option value="quiz">Quiz</option>
		<option value="img">Img</option>
	</select>

	<form id="textForm" method="POST" action="{{route}}">
		@crsf
		<label>Question text</label>
		<input type="text" name="question_text">
		<label>Question image</label>
		<input type="file" name="question_image">
		<input type="hidden" name="lat">
		<input type="hidden" name="lng">
		<input type="hidden" name="order">
		<input type="hidden" name="circuit_id">
		<input type="text" name="answer">
		<input type="submit">
	</form>
	<form id="quizForm">
		<label>Correct answer</label>
		<input type="text" name="correct_ans">
		<label>Possible answer 1</label>
		<input type="text" name="possible_ans1">
		<label>Possible answer 2</label>
		<input type="text" name="possible_ans2">
		<label>Possible answer 3</label>
		<input type="text" name="possible_ans3">
		<input type="submit">
	</form>

	<script type="text/javascript">
		$(function() {
			$('form').hide();
			$('#textForm').show();
			
			$('#selector').change(function(event) {
				$('form').hide();
				$('#' + $('#selector').val() + "Form").show();
			});

		});
	</script>
</body>

</html>