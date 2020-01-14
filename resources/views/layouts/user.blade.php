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
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">


  <!-- Libraries -->
  <script src="{{asset('/assets/lib/jquery-3.4.1.min.js')}}"></script>
  <script src="{{asset('/assets/lib/popper.min.js')}}"></script>
  <script src="{{asset('/assets/lib/bootstrap/js/bootstrap.min.js')}}"></script>

  <!-- Scripts -->
  <script src="{{asset('/assets/js/main.js')}}"></script>
  <script src="{{asset('/assets/js/animations.js')}}"></script>
  <script>
  var base_url = "{{asset('/')}}";
  console.log(base_url)
  </script>
  @yield('imports')

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
          <a class="nav-link" href="{{route('games.joinCaretaker')}}">Unirse a una partida</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('circuit.create')}}">Crear circuito</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img id="avatarImg" src="{{Auth::user()->avatar ? route('storage','avatars/'.Auth::user()->avatar) : asset('assets/img/logoPNG.png')}}"><img>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{route('user.show',['username'=>Auth::user()->username])}}">Mi perfil</a>
            <a class="dropdown-item" href="{{route('games.historic')}}">Circuitos jugados</a>
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
  <div id="main" class="p-1">
    @yield('content')
  </div>
  <script>
    @yield('js')
  </script>
</body>

</html>