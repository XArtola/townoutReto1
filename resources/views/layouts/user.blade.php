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
  <link rel="stylesheet" href="{{asset('/assets/css/userStyles.css')}}">


  <!-- Libraries -->
  <script src="{{asset('/assets/lib/jquery-3.4.1.min.js')}}"></script>
  <script src="{{asset('/assets/lib/popper.min.js')}}"></script>
  <script src="{{asset('/assets/lib/bootstrap/js/bootstrap.min.js')}}"></script>

  <!-- Scripts -->
  <script src="{{asset('/assets/js/main.js')}}"></script>
  <script src="{{asset('/assets/js/animations.js')}}"></script>


</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-townout">
    <a class="navbar-brand" href="{{route('user.home')}}"><img class="img-fluid" src={{asset('assets/img/logoPNG.png')}}></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">Unirse a una partida</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Crear circuito</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img id="avatarImg" src="{{Auth::user()->avatar ? Auth::user()->avatar : asset('assets/img/logoPNG.png')}}"><img>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{route('user.show',['username'=>Auth::user()->username])}}">Mi perfil</a>
            <a class="dropdown-item" href="#">Circuitos jugados</a>
            <div class="dropdown-divider"></div>

            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
              Cerrar sesión
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </li>
        <li><a class="nav-link" href="{{ route('change_lang',['lang'=>'en']) }}">En</a></li>
        <li><a class="nav-link" href="{{ url('lang/es') }}">Es</a></li>
        <li><a class="nav-link" href="{{ url('lang/eu')}}">Eu</a></li>
      </ul>

    </div>
  </nav>
  <div id="main">
    @yield('content')
  </div>
  <script>
    @yield('js')
  </script>
</body>

</html>