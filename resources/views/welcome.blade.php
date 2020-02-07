<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Townout</title>

    <link rel="icon" href="{{ URL::asset('/assets/img/favicon/favicon.png') }}" type="image/x-icon"/>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('/assets/lib/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/styles.css')}}">

    <!-- Libraries -->
    <script src="{{asset('/assets/lib/jquery-3.4.1.min.js',\App::environment() == 'production')}}"></script>
    <script src="{{asset('/assets/lib/popper.min.js',\App::environment() == 'production')}}"></script>
    <script src="{{asset('/assets/lib/bootstrap/js/bootstrap.min.js',\App::environment() == 'production')}}"></script>
    <script src="{{asset('/assets/lib/bootstrap/js/bootstrap.bundle.min.js',\App::environment() == 'production')}}"></script>
    <script src="{{asset('/assets/lib/translate.js',\App::environment() == 'production')}}"></script>


    <!-- Scripts -->
    <script src="{{asset('/assets/js/translations.js',\App::environment() == 'production')}}"></script>
    <script src="{{asset('/assets/js/main.js',\App::environment() == 'production')}}"></script>
    <script src="{{asset('/assets/js/animations.js',\App::environment() == 'production')}}"></script>

</head>

<body class="loading">

    <div id="loader-content">
        <svg id="loader" data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128.33 128.33">
            <defs>
                <style>
                    .cls-1,
                    .cls-2 {
                        fill: #3c3c3b;
                    }

                    .cls-2 {
                        stroke: #1d1d1b;
                    }

                    .cls-2,
                    .cls-3 {
                        stroke-miterlimit: 10;
                    }

                    .cls-3,
                    .cls-4 {
                        fill: none;
                    }

                    .cls-3 {
                        stroke: #3c3c3b;
                        stroke-width: 11px;
                    }

                    .cls-5 {
                        fill: #f9be2f;
                    }

                    .cls-6 {
                        fill: #e94936;
                    }
                </style>
            </defs>
            <title>logo</title>
            <circle class="cls-3" cx="63.72" cy="63.720" r="58.22" />
            <polygon class="cls-5" points="99.13 55.93 136.4 34.46 114.54 71.5 99.13 55.93" transform="translate(-43.12 0)" />
            <polygon class="cls-6" points="77.26 92.98 99.13 55.93 114.54 71.5 77.26 92.98" transform="translate(-43.12 0)" />
            <path class="cls-1" d="M164,82.31a5.94,5.94,0,1,0,5.9,6A5.93,5.93,0,0,0,164,82.31Z" transform="translate(-100.27 -24.52)" />
        </svg>
    </div>

    @if (old('confirm')=="register" && $errors->any())

    <script>
        //Muestra la ventana modal en caso de que existan errores
        $(function() {
            $('#registerModal').modal('show');
        });
    </script>
    @endif

    @if(old('confirm')=="login" && $errors->any())

    <script>
        //Muestra la ventana modal en caso de que existan errores
        $(function() {
            $('#loginModal').modal('show');
        });
    </script>
    @endisset

    @if (session('notification'))

    <script>
        //Muestra exista una notificación
        $(function() {
            $('#validateModal').modal('show');
        });
    </script>
    @endif

    @if (session('warning'))

    <script>
        //Muestra exista una notificación
        $(function() {
            $('#validationRequiredModal').modal('show');
        });
    </script>
    @endif

    <nav>
        <img id="menuToggle" src="{{asset('/assets/img/icons/menu.svg',\App::environment() == 'production')}}">
        <ul>
            @guest
            <li>
                <button type="button" data-toggle="modal" data-target="#registerModal">@lang('main.call')</button>
            </li>
            <li class="nav-item">
                <button type="button" data-toggle="modal" data-target="#loginModal">@lang('main.sign-in')</button>
            </li>
            @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    {{ __('Mis datos') }}
                    </a>
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
            <li><a href="{{ route('change_lang',['lang'=>'en']) }}">En</a></li>
            <li><a href="{{ url('lang/es') }}">Es</a></li>
            <li><a href="{{ url('lang/eu')}}">Eu</a></li>
        </ul>

    </nav>
    <!-- Modal Register-->
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
                    <form action="{{ route('register') }}" method="POST" class="row px-2" id="register_form">
                        @csrf

                        <!--Username field-->
                        <div class="form-group col-lg-6 register">
                            <label for="registerUsername">@lang('main.modal-username')</label>
                            <input type="text" class="form-control" id="registerUsername" name="username" placeholder="@lang('main.modal-username')" value="{{old('username')}}">
                            <span class="error" data-for="regis_username"></span>
                            @if($errors->has('username'))
                            <span class="pl-1 text-danger">{{$errors->first('username')}}</span>
                            @endif
                        </div>

                        <!--Name field-->

                        <div class="form-group col-lg-6 register">
                            <label for="registerName">@lang('main.modal-name')</label>
                            <input type="text" class="form-control" id="registerName" name="name" placeholder="@lang('main.modal-name')" value="{{old('name')}}">
                            <span class="error" data-for="regis_name"></span>
                            @if($errors->has('name'))
                            <span class="pl-1 text-danger">{{$errors->first('name')}}</span>
                            @endif
                        </div>
                        <!--Surname field-->

                        <div class="form-group col-lg-6 register">
                            <label for="registerSurname">@lang('main.modal-surname')</label>
                            <input type="text" class="form-control" id="registerSurname" name="surname" placeholder="@lang('main.modal-surname')" value="{{old('surname')}}">
                            <span class="error" data-for="regis_surname"></span>
                            @if($errors->has('surname'))
                            <span class="pl-1 text-danger">{{$errors->first('surname')}}</span>
                            @endif
                        </div>

                        <!--Email field-->

                        <div class="form-group col-lg-6 register">
                            <label for="registerEmail">@lang('main.modal-email')</label>
                            <input type="email" class="form-control" id="registerEmail" name="email" placeholder="@lang('main.modal-email')" value="{{old('email')}}">
                            <span class="error" data-for="regis_email"></span>
                            @if($errors->has('email'))
                            <span class="pl-1 text-danger">{{$errors->first('email')}}</span>
                            @endif
                        </div>

                        <!--Password field-->

                        <div class="form-group col-lg-6 register">
                            <label for="registerPassword">@lang('main.modal-passwd')</label>
                            <input type="password" class="form-control" id="registerPassword" name="password" placeholder="@lang('main.modal-passwd')">
                            <span class="error" data-for="regis_password"></span>
                            @if($errors->has('password'))
                            <span class="pl-1 text-danger">{{$errors->first('password')}}</span>
                            @endif
                        </div>

                        <!--Password_confirmation field-->

                        <div class="form-group col-lg-6 register">
                            <label for="registerPassword">@lang('main.modal-repeat-passwd')</label>
                            <input type="password" class="form-control" id="registerPassword" name="password_confirmation" placeholder="@lang('main.modal-repeat-passwd')">
                            <span class="error" data-for="regis_confirmpassword"></span>
                            @if($errors->has('password'))
                            <span class="pl-1 text-danger">{{$errors->first('password_confirmation')}}</span>
                            @endif
                        </div>

                        <!--

                        <input type="password" name="password" class="col-10 my-1 mx-auto" placeholder="@lang('main.modal-passwd')" value="{{old('password')}}">
                        <input type="password" name="password_confirmation" class="col-10 my-1 mx-auto" placeholder="@lang('main.modal-repeat-passwd')" value="{{old('password_confirmation')}}">
                    -->
                        <div class="modal-footer" style="width: 100%">
                            <button type="button" class="btn btn-primary" name="confirm" value="register" id="register_send">@lang('main.sign-up')</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
    </div>


    <!-- Modal Login-->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="registerModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Iniciar sesión</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('login') }}" method="POST" class="row px-2" id="login_form">
                        @csrf

                        <div class="form-group col-lg-6 login">
                            <label for="eloginEmail">@lang('main.modal-email')</label>
                            <input type="email" class="form-control" id="loginEmail" name="email" placeholder="@lang('main.modal-email')" value="{{old('email')}}">
                            <span class="error" data-for="login_email"></span>
                            @if($errors->has('email'))
                            <span class="pl-1 text-danger">{{$errors->first('email')}}</span>
                            @endif
                        </div>

                        <div class="form-group col-lg-6 login">
                            <label for="loginPassword">@lang('main.modal-passwd')</label>
                            <input type="password" class="form-control" id="loginPassword" name="password" placeholder="@lang('main.modal-passwd')">
                            <span class="error" data-for="login_password"></span>
                            @if($errors->has('password'))
                            <span class="pl-1 text-danger">{{$errors->first('password')}}</span>
                            @endif
                        </div>


                        <div class="form-group row col-lg-11 col-md-11 col-sm-12 mx-auto">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-check mx-auto">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('main.remember-me') }}
                                    </label>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6">

                                @if (Route::has('password.request'))
                                <a class="btn btn-link mx-auto" href="{{ route('password.request') }}">
                                    {{ __('main.forgot-passwd') }}
                                </a>
                                @endif
                            </div>
                        </div>

                        <div class="modal-footer" style="width: 100%">
                            <button type="button" class="btn btn-primary" name="confirm" value="login" id="login_send">@lang('main.sign-in')</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>


    <!-- Modal validate-->
    <div class="modal fade" id="validateModal" tabindex="-1" role="dialog" aria-labelledby="registerModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">@lang('main.modal-verified')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <p class="p-4 text-justify"> @lang('main.modal-verified-message')</p>

            </div>
        </div>
    </div>
    </div>

    <!-- Modal validation required-->
    <div class="modal fade" id="validationRequiredModal" tabindex="-1" role="dialog" aria-labelledby="registerModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">@lang('main.modal-notverified')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <p class="p-4 text-justify"> @lang('main.modal-notverified-message')</p>

            </div>
        </div>
    </div>
    </div>

    <header id="header">
        <div id="header-texto">
            <h1 class="display-4 font-weight-bold">@lang('main.header-h1')</h1>
            <h3 class="display-4">@lang('main.header-h3')</h3>
        </div>
        <div id="logo">
            <img src="{{asset('/assets/img/logo.svg',\App::environment() == 'production')}}" class="scaledsvg">
        </div>
        <div id="mobile">
            <img src="{{asset('/assets/img/mobile.png',\App::environment() == 'production')}}">
        </div>
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
        <img class="placemarks" id="pm1" src="{{asset('/assets/img/icons/placemark.svg',\App::environment() == 'production')}}">
        <img class="placemarks" id="pm2" src="{{asset('/assets/img/icons/placemark.svg',\App::environment() == 'production')}}">
        <img class="placemarks" id="pm3" src="{{asset('/assets/img/icons/placemark.svg',\App::environment() == 'production')}}">



        <a href="#s1" class="same-page-nav" id="arrow_down"><img src="{{asset('/assets/img/icons/arrow_down.svg',\App::environment() == 'production')}}"></a>
    </header>
    <section id="s1">
        <h1>@lang('main.s1-h1')</h1>
        <a href="#contacto" class="same-page-nav" id="contacto-link">@lang('main.s1-a')</a>
    </section>
    <section id="s2">
        <div>
            <h2>@lang('main.s2-h2a')</h2>
            <img src="{{asset('/assets/img/qa.svg',\App::environment() == 'production')}}">
        </div>
        <div>
            <h2>@lang('main.s2-h2b')</h2>
            <img src="{{asset('/assets/img/explorer.svg',\App::environment() == 'production')}}">
        </div>
    </section>
    <section id="s3">
        <div class="card-deck p-4 col-12">
            <div class="card col-lg-4 col-md-6 col-sm-12">
                <img src="{{asset('assets/img/brujula.png',\App::environment() == 'production')}}" class="card-img-top cardImg align-self-start mt-1 p-4" alt="...">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold text-uppercase">@lang('main.s3-h5-1')</h5>
                    <p class="card-text">@lang('main.s3-p-1')</p>
                </div>
            </div>
            <div class="card col-lg-4 col-md-6 col-sm-12">
                <img src="{{asset('assets/img/interrogacion.svg',\App::environment() == 'production')}}" class="card-img-top cardImg align-self-start mt-1 p-4" alt="...">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold text-uppercase">@lang('main.s3-h5-2')</h5>
                    <p class="card-text">@lang('main.s3-p-2')</p>
                </div>
            </div>
            <div class="card col-lg-4 col-md-6 col-sm-12">
                <img src="{{asset('assets/img/pointer.png',\App::environment() == 'production')}}" class="card-img-top cardImg align-self-start mt-1 p-4" alt="...">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold text-uppercase">@lang('main.s3-h5-3')</h5>
                    <p class="card-text">@lang('main.s3-p-3')</p>
                </div>
            </div>
        </div>

    </section>

    </section>
    <section id="contacto">
        <h2>@lang('main.contact')</h2>
        <form action="{{route('contact-message')}}" method="post" id="contacto-form">
            @csrf
            <div id="inputs">
                <input type="text" name="nombre" placeholder="@lang('main.contact-name')">
                <span class="error" data-for="nombre"></span>
                @if($errors->has('nombre'))
                <span class="pl-1 text-danger">{{$errors->first('nombre')}}</span>
                @endif
                <input type="text" name="apellido" placeholder="@lang('main.contact-surname')">
                <span class="error" data-for="apellido"></span>
                @if($errors->has('apellido'))
                <span class="pl-1 text-danger">{{$errors->first('apellido')}}</span>
                @endif
                <input type="email" name="email" placeholder="@lang('main.contact-email')">
                <span class="error" data-for="email"></span>
                @if($errors->has('email'))
                <span class="pl-1 text-danger">{{$errors->first('email')}}</span>
                @endif
                <textarea name="mensaje" placeholder="@lang('main.contact-message')"></textarea>
                <span class="error" data-for="mensaje"></span>
                @if($errors->has('mensaje'))
                <span class="pl-1 text-danger">{{$errors->first('mensaje')}}</span>
                @endif
            </div>
            <button type="button" id="contact_send"><img src="{{asset('/assets/img/icons/send.svg',\App::environment() == 'production')}}"></button>
        </form>
    </section>
    <footer>
        Xabier Artola &amp Koldo Intxausti &amp Nerea Labandera &copy<br>2019
        <div>
            <img src="{{asset('/assets/img/icons/instagram.svg',\App::environment() == 'production')}}">
            <img src="{{asset('/assets/img/icons/twitter.svg',\App::environment() == 'production')}}">
            <img src="{{asset('/assets/img/icons/facebook.svg',\App::environment() == 'production')}}">
        </div>
    </footer>
</body>

</html>