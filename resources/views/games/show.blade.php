<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Townout') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('/assets/lib/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/styles.css')}}">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Libraries -->
    <script src="{{asset('/assets/lib/jquery-3.4.1.min.js')}}"></script>
    <script src="{{asset('/assets/lib/popper.min.js')}}"></script>
    <script src="{{asset('/assets/lib/bootstrap/js/bootstrap.min.js')}}"></script>

</head>
<body>
	<div class="container">
		<div>
			<h1>FIN DEL CIRCUITO!</h1>
			<div>
				<p></p>
			</div>
		</div>
	</div>

</body>
</html>