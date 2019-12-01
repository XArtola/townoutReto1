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
    <script src="{{asset('/assets/lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>


    <!-- Scripts -->
    <script src="{{asset('/assets/js/main.js')}}"></script>
    <script src="{{asset('/assets/js/animations.js')}}"></script>


</head>

<body>

    @if ($errors->any())

    <script>
        //Muestra la ventana modal en caso de que existan errores
        $(function() {
            $('#registerModal').modal('show');
        });
    </script>
    @endif

    @if ($errors->any())

    <script>
        //Muestra la ventana modal en caso de que existan errores
        $(function() {
            $('#registerModal').modal('show');
        });
    </script>
    @endif

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
        <img id="menuToggle" src="{{asset('/assets/img/icons/menu.svg')}}">
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
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">

                        {{ __('Mis datos') }}
                    </a>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Ajustes') }}
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
                    <form action="{{ route('register') }}" method="POST" class="row px-2">
                        @csrf

                        <!--Username field-->
                        <div class="form-group col-lg-6">
                            <label for="registerUsername">@lang('main.modal-username')</label>
                            <input type="text" class="form-control" id="registerUsername" name="username" placeholder="@lang('main.modal-username')" value="{{old('username')}}">
                            @if($errors->has('username'))
                            <span class="pl-1 text-danger">{{$errors->first('username')}}</span>
                            @endif
                        </div>

                        <!--Name field-->

                        <div class="form-group col-lg-6">
                            <label for="registerName">@lang('main.modal-name')</label>
                            <input type="text" class="form-control" id="registerName" name="name" placeholder="@lang('main.modal-name')" value="{{old('name')}}">
                            @if($errors->has('name'))
                            <span class="pl-1 text-danger">{{$errors->first('name')}}</span>
                            @endif
                        </div>
                        <!--Surname field-->

                        <div class="form-group col-lg-6">
                            <label for="registerSurname">@lang('main.modal-surname')</label>
                            <input type="text" class="form-control" id="registerSurname" name="surname" placeholder="@lang('main.modal-surname')" value="{{old('surname')}}">
                            @if($errors->has('surname'))
                            <span class="pl-1 text-danger">{{$errors->first('surname')}}</span>
                            @endif
                        </div>

                        <!--Email field-->

                        <div class="form-group col-lg-6">
                            <label for="registerEmail">@lang('main.modal-email')</label>
                            <input type="email" class="form-control" id="registerEmail" name="email" placeholder="@lang('main.modal-email')" value="{{old('email')}}">
                            @if($errors->has('email'))
                            <span class="pl-1 text-danger">{{$errors->first('email')}}</span>
                            @endif
                        </div>

                        <!--Password field-->

                        <div class="form-group col-lg-6">
                            <label for="registerPassword">@lang('main.modal-passwd')</label>
                            <input type="password" class="form-control" id="registerPassword" name="password" placeholder="@lang('main.modal-passwd')">
                            @if($errors->has('password'))
                            <span class="pl-1 text-danger">{{$errors->first('password')}}</span>
                            @endif
                        </div>

                        <!--Password_confirmation field-->

                        <div class="form-group col-lg-6">
                            <label for="registerPassword">@lang('main.modal-repeat-passwd')</label>
                            <input type="password" class="form-control" id="registerPassword" name="password_confirmation" placeholder="@lang('main.modal-repeat-passwd')">
                            @if($errors->has('password'))
                            <span class="pl-1 text-danger">{{$errors->first('password_confirmation')}}</span>
                            @endif
                        </div>

                        <!--

                        <input type="password" name="password" class="col-10 my-1 mx-auto" placeholder="@lang('main.modal-passwd')" value="{{old('password')}}">
                        <input type="password" name="password_confirmation" class="col-10 my-1 mx-auto" placeholder="@lang('main.modal-repeat-passwd')" value="{{old('password_confirmation')}}">
    -->
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </form>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('main.modal-cancel')</button>
                    <button type="submit" class="btn btn-primary">@lang('main.sign-up')</button>
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
                    <form action="{{ route('login') }}" method="POST" class="row px-2">
                        @csrf

                        <div class="form-group col-lg-6">
                            <label for="eloginEmail">@lang('main.modal-email')</label>
                            <input type="email" class="form-control" id="loginEmail" name="email" placeholder="@lang('main.modal-email')" value="{{old('email')}}">
                            @if($errors->has('email'))
                            <span class="pl-1 text-danger">{{$errors->first('email')}}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="loginPassword">@lang('main.modal-passwd')</label>
                            <input type="password" class="form-control" id="loginPassword" name="password" placeholder="@lang('main.modal-passwd')">
                            @if($errors->has('password'))
                            <span class="pl-1 text-danger">{{$errors->first('password')}}</span>
                            @endif
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('main.sign-in')
                                </button>

                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Registrar</button>
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
            <img src="{{asset('/assets/img/logo.svg')}}" class="scaledsvg">
        </div>
        <div id="mobile">
            <img src="{{asset('/assets/img/mobile.png')}}">
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
        <img class="placemarks" id="pm1" src="{{asset('/assets/img/icons/placemark.svg')}}">
        <img class="placemarks" id="pm2" src="{{asset('/assets/img/icons/placemark.svg')}}">
        <img class="placemarks" id="pm3" src="{{asset('/assets/img/icons/placemark.svg')}}">



        <a href="#s1" class="same-page-nav" id="arrow_down"><img src="{{asset('/assets/img/icons/arrow_down.svg')}}"></a>
    </header>
    <section id="s1">
        <h1>@lang('main.s1-h1')</h1>
        <a href="#contacto" class="same-page-nav" id="contacto-link">@lang('main.s1-a')</a>
    </section>
    <section id="s2">
        <div>
            <h2>@lang('main.s2-h2a')</h2>
            <img src="{{asset('/assets/img/qa.svg')}}">
        </div>
        <div>
            <h2>@lang('main.s2-h2b')</h2>
            <img src="{{asset('/assets/img/explorer.svg')}}">
        </div>
    </section>
    <section id="s3">
        <div class="card-deck p-4 col-12">
            <div class="card col-lg-4 col-md-6 col-sm-12">
                <img src="{{asset('assets/img/brujula.png')}}" class="card-img-top cardImg align-self-start mt-1 p-4" alt="...">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold text-uppercase">Inicia TownOut</h5>
                    <p class="card-text">Accede a la página web desde cualquier dispositivo con conexión a internet</p>
                </div>
            </div>
            <div class="card col-lg-4 col-md-6 col-sm-12">
                <img src="{{asset('assets/img/interrogacion.svg')}}" class="card-img-top cardImg align-self-start mt-1 p-4" alt="...">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold text-uppercase">Escoge una experiencia</h5>
                    <p class="card-text">Escoge la experiencia que quieras vivir del la selección. Usuarios como guías turísticos profesionales pueden crearlas.</p>
                </div>
            </div>
            <div class="card col-lg-4 col-md-6 col-sm-12">
                <img src="{{asset('assets/img/pointer.png')}}" class="card-img-top cardImg align-self-start mt-1 p-4" alt="...">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold text-uppercase">Empieza a explorar</h5>
                    <p class="card-text">Sigue las pistas, resuelve los acertijos y supera el reto</p>
                </div>
            </div>
        </div>
    </section>
    <section id="contacto">
        <h2>@lang('main.contact')</h2>
        <form action="{{route('contact-message')}}" method="post" id="contacto-form">
            @csrf
            <div id="inputs">
                <input type="text" name="nombre" placeholder="@lang('main.contact-name')">
                <span class="error" data-for="nombre"></span>
                <input type="email" name="email" placeholder="@lang('main.contact-email')">
                <span class="error" data-for="email"></span>
                <textarea name="mensaje" placeholder="@lang('main.contact-message')"></textarea>
                <span class="error" data-for="mensaje"></span>
            </div>
            <button type="button" id="send"><img src="{{asset('/assets/img/icons/send.svg')}}"></button>
        </form>
    </section>
    <footer>
        Xabier Artola & Koldo Intxausti & Nerea Labandera &copy<br>2019
        <div>
            <img src="{{asset('/assets/img/icons/instagram.svg')}}">
            <img src="{{asset('/assets/img/icons/twitter.svg')}}">
            <img src="{{asset('/assets/img/icons/facebook.svg')}}">
        </div>
    </footer>
</body>

</html>