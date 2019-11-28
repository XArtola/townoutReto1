<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

	<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#miModal">
		Registrate!
	</button>

	<div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Formulario de registro</h4>
				</div>
				<div class="modal-body">
					<form>
						<input type="text" name="" placeholder="Correo Electrónico">
						<input type="password" name="" placeholder="Contraseña">
						<br><br>
						<input type="submit" name="" value="Registrarse">
					</form>
				</div>
			</div>
		</div>
	</div>

</body>
</html>