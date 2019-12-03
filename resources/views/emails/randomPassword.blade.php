<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('/assets/lib/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/styles.css')}}">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">

    <!-- Libraries -->
    <script src="{{asset('/assets/lib/jquery-3.4.1.min.js')}}"></script>
    <script src="{{asset('/assets/lib/popper.min.js')}}"></script>
    <script src="{{asset('/assets/lib/bootstrap/js/bootstrap.min.js')}}"></script>
    
    <style>
    	*{
    		margin: 0!important;
    	}
    	#content{
    		background-color: #e1e9ea;
    		margin: 0;
    		color:#7d7d7d;
    		font-family: verdana;
    	}
    	header{
    		background-color:#a5bec0;
    		width:100%;
    		padding:20px 0;
    		display: flex;
    		justify-content: center;
    		margin: 0;
    	}
    	header img, header a {
    		width: 170px;
    		margin:0 auto;
    	}
    	.button{
    		padding:10px 15px;
    		border-radius:7px;
    		background-color: #587b7f;
    		color: white!important; 
    		font-weight: bold; 
    		margin:0 auto;
    		width: 50px;
    		text-decoration: none;
    	}
    	#link{
    		height: 150px;
    	}
    </style>
</head>
<body>
	<header>
	    <a href="http://127.0.0.1:8000"><img src="<?php echo $message->embed(public_path('assets/img/logoPNG.png')); ?>"></a>
	</header>
	<div id="content">
	    <h2>Hola {{ $username }}, alguien ha creado un usuario administrador para ti en <strong>TownOut</strong>!</h2>
	    
	    <p>Estos son tus datos de autenticación:</p>
	    <ul>
	    	<li><strong>Nombre de usuario:</strong> {{$username}}</li>
	    	<li><strong>Password:</strong> {{$randomPassword}}</li>
	    </ul>

	    <p>Para activar la cuenta debe hacer click sobre el siguiente enlace:</p>
	    <div id="link">
		    <a href="{{$url}}" class="button">
		        Activar Cuenta
		    </a>
		</div>
	</div>
</body>
</html>