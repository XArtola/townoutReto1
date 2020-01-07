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

	<form id="textForm">
		<label>Answer</label>
		<input type="text" name="name">

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
	</form>

	<script type="text/javascript">

		$(function(){
			$('form').hide();

			$('#selector').change(function(event) {
				$('form').hide();
				$('#'+$('#selector').val()+"Form").show();
			});

		});

	</script>
</body>
</html>