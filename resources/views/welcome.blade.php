<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Townout</title>

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
</head>

<body>
    <nav>
        <img id="menuToggle" src="{{asset('/assets/img/icons/menu.svg')}}">
        <ul>
            <li><button type="button" data-toggle="modal" data-target="#registerModal">¿Aún no te has registrado?</button></li>
            @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('¿Aún no te has registrado?') }}</a>
            </li>
            @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
            @endif
            @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
            @endguest
        </ul>
    </nav>
    <!-- Modal -->
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Registrar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" class="row px-2">
                            <input type="text" name="username" class="col-12 my-1" placeholder="Nombre de usuario">
                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <input type="text" name="name" class="col-6 my-1" placeholder="Nombre">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <input type="email" name="email" class="col-6 my-1" placeholder="Correo electrónico">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <input type="password" name="password" class="col-6 my-1" placeholder="Contraseña">
                            <input type="password" name="password-confirm" class="col-6 my-1" placeholder="Repite tu contraseña">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="sumnit" class="btn btn-primary">Registrar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <header id="header">
        <!-- LOGO IMAGE SVG PATH -->
        <div id="logo">
            <img src="{{asset('/assets/img/logo.svg')}}" class="scaledsvg">
        </div>
        <div id="mobile">
            <img src="{{asset('/assets/img/mobile.png')}}">
        </div>
        <h1 class="display-4 font-weight-bold">Una nueva forma de descubrir el mundo</h1>
        <!-- PLACEMARKS PARA ANIMACIÓN-->
        <svg id="pm0" class="placemarks" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 255.856 255.856" xml:space="preserve">
            <g>
                <path style="fill:#bd2830" d="M127.928,38.8c-30.75,0-55.768,25.017-55.768,55.767s25.018,55.767,55.768,55.767
                        s55.768-25.017,55.768-55.767S158.678,38.8,127.928,38.8z M127.928,135.333c-22.479,0-40.768-18.288-40.768-40.767
                        S105.449,53.8,127.928,53.8s40.768,18.288,40.768,40.767S150.408,135.333,127.928,135.333z" />
                <path style="fill:#bd2830" d="M127.928,0C75.784,0,33.362,42.422,33.362,94.566c0,30.072,25.22,74.875,40.253,98.904
                        c9.891,15.809,20.52,30.855,29.928,42.365c15.101,18.474,20.506,20.02,24.386,20.02c3.938,0,9.041-1.547,24.095-20.031
                        c9.429-11.579,20.063-26.616,29.944-42.342c15.136-24.088,40.527-68.971,40.527-98.917C222.495,42.422,180.073,0,127.928,0z
                         M171.569,181.803c-19.396,31.483-37.203,52.757-43.73,58.188c-6.561-5.264-24.079-26.032-43.746-58.089
                        c-22.707-37.015-35.73-68.848-35.73-87.336C48.362,50.693,84.055,15,127.928,15c43.873,0,79.566,35.693,79.566,79.566
                        C207.495,112.948,194.4,144.744,171.569,181.803z" />
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
        </svg>
        <img class="placemarks" id="pm1" src="{{asset('/assets/img/icons/placemark.svg')}}">
        <img class="placemarks" id="pm2" src="{{asset('/assets/img/icons/placemark.svg')}}">
        <img class="placemarks" id="pm3" src="{{asset('/assets/img/icons/placemark.svg')}}">



        <a href="#s1" class="same-page-nav" id="arrow_down"><img src="{{asset('/assets/img/icons/arrow_down.svg')}}"></a>
    </header>
    <section id="s1">
        <h1>Explora tu ciudad</h1>
        <a href="#contacto" class="same-page-nav" id="contacto-link">CONTACTO</a>
    </section>
    <section id="s2">
        <div>
            <h2>Crea tu propia experiencia</h2>
            <img src="{{asset('/assets/img/qa.svg')}}">
        </div>
        <div>
            <h2>o vive una ya diseñada</h2>
            <img src="{{asset('/assets/img/explorer.svg')}}">
        </div>
    </section>
    <section id="contacto">
        <h2>¡Contacta con nosotros!</h2>
        <form action="{{route('contact-message')}}" method="post" id="contacto-form">
            @csrf
            <div id="inputs">
                <input type="text" name="nombre" placeholder="Nombre">
                <span class="error" data-for="nombre"></span>
                <input type="email" name="email" placeholder="Correo electrónico">
                <span class="error" data-for="email"></span>
                <textarea name="mensaje" placeholder="Mensaje"></textarea>
                <span class="error" data-for="mensaje"></span>
            </div>
            <button type="button" id="send"><img src="{{asset('/assets/img/icons/send.svg')}}"></button>
        </form>
    </section>
    <footer>
        Koldo Intxausti &copy, 2019
        <div>
            <img src="{{asset('/assets/img/icons/instagram.svg')}}">
            <img src="{{asset('/assets/img/icons/twitter.svg')}}">
            <img src="{{asset('/assets/img/icons/facebook.svg')}}">
        </div>
    </footer>
</body>

</html>