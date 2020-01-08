<form action="" method="post">
	@csrf
	<div>
		<label>Nombre del circuit</label>
		<input type="text" name="name">
	</div>
	<div>
		<label>Description of the circuit</label>
		<textarea name="description"></textarea>
	</div>
	<div>
		<label>Imgage</label>
		<input type="file" name="img">
	</div>
	<div>
		<label>City</label>
		<input type="text" name="city">
	</div>
	<div>
		<label>Difficulty</label>
		<select>
			<option disabled="" selected="">Select a difficulty</option>
			<option>Easy</option>
			<option>Medium</option>
			<option>Difficult</option>
		</select>
	</div>
	<div>
		<label>Duration</label>
		<input type="number" name="duration" min="0" max="180" step="5" value="60">
	</div>
	
	
</form>