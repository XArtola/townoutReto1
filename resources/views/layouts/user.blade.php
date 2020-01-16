<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>@yield('title') - Townout</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

  <!-- Styles -->
  <link rel="stylesheet" href="{{secure_asset('/assets/lib/bootstrap/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{secure_asset('/assets/css/styles.css')}}">
  <link rel="stylesheet" href="{{secure_asset('/assets/css/userStyles.css')}}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">


  <!-- Libraries -->
  <script src="{{secure_asset('/assets/lib/jquery-3.4.1.min.js')}}"></script>
  <script src="{{secure_asset('/assets/lib/popper.min.js')}}"></script>
  <script src="{{secure_asset('/assets/lib/bootstrap/js/bootstrap.min.js')}}"></script>

  <!-- Scripts -->
  <script src="{{secure_asset('/assets/js/main.js')}}"></script>
  <script src="{{secure_asset('/assets/js/animations.js')}}"></script>
  <script>
    var base_url = "{{secure_asset('/')}}";
    console.log(base_url)
  </script>
  @yield('imports')

</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top">
    <a class="navbar-brand" href="{{route('user.home')}}">
      <img src="{{ secure_asset('assets/img/compressed-white-logo.svg') }}" alt="home">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{route('games.joinCaretaker')}}">@lang('games.join_game')</a>
        </li>
        <li class="nav-item">
          <a class="nav-link new-circuit" href="{{route('circuit.create')}}"><img src="{{asset('/assets/img/map.svg')}}" alt="crear circuito"></a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="langDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="{{asset('/assets/img/lang.svg')}}" alt="languages">
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="langDropdown">
            <a class="dropdown-item" href="{{ route('change_lang',['lang'=>'en']) }}">En</a>
            <a class="dropdown-item" href="{{ url('lang/es') }}">Es</a>
            <a class="dropdown-item" href="{{ url('lang/eu')}}">Eu</a>
          </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img id="avatarImg" class="rounded-circle" src="{{Auth::user()->avatar ? route('storage','avatars/'.Auth::user()->avatar) : asset('/assets/img/logoPNG.png')}}"><img>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{route('user.show',['username'=>Auth::user()->username])}}">@lang('user.profile')</a>
            <a class="dropdown-item" href="{{route('games.historic')}}">@lang('games.historic')</a>
            <div class="dropdown-divider"></div>

            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
              @lang('user.logout')
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </li>
        </div>
      </ul>

    </div>
  </nav>
  <div id="main">
    @yield('content')
  </div>
  <script>
    @yield('js')
  </script>
  <!-- Footer -->
  <footer class="page-footer font-small cyan darken-3 mt-4">

    <!-- Footer Elements -->
    <div class="container">

      <!-- Grid row-->
      <div class="row">

        <!-- Grid column -->
        <div class="col-md-12 py-5">
          <div class="mb-5 flex-center">

            <!-- Facebook -->
            <a class="fb-ic linkFooter">
              <i class="fab fa-facebook-f fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
            </a>
            <!-- Twitter -->
            <a class="tw-ic linkFooter">
              <i class="fab fa-twitter fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
            </a>
            <!--Instagram-->
            <a class="ins-ic linkFooter">
              <i class="fab fa-instagram fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
            </a>
           
          </div>
        </div>
        <!-- Grid column -->

      </div>
      <!-- Grid row-->

    </div>
    <!-- Footer Elements -->

  </footer>
  <!-- Footer -->
</body>

</html>