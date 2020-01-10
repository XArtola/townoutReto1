<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title') - Townout</title>


        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('/assets/lib/bootstrap/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('/assets/css/styles.css')}}">

        <!-- Libraries -->
        <script src="{{asset('/assets/lib/jquery-3.4.1.min.js')}}"></script>
        <script src="{{asset('/assets/lib/popper.min.js')}}"></script>
        <script src="{{asset('/assets/lib/bootstrap/js/bootstrap.min.js')}}"></script>

        <!-- Scripts -->
        <script src="{{asset('/assets/js/main.js')}}"></script>
        <script src="{{asset('/assets/js/animations.js')}}"></script>

        @yield('imports')

    </head>
    <body>
        <nav>
            <ul>
            <li><a href="#">Circuitos</a></li>
            <li><a href="{{ route('user.show', auth()->user()->username) }}">Perfil</a></li>
            <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
                </a></li>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </ul>
        </nav>
        <div id="main">
            @yield('content')
        </div>
        <script>
            @yield('js')
        </script>
    </body>
</html>
