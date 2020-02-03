<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Control Panel</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('assets/css/dashboard.css',\App::environment() == 'production')}}" rel="stylesheet">
    <link href="{{asset('assets/lib/bootstrap/css/bootstrap.min.css',\App::environment() == 'production')}}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js" type="text/javascript"></script>
    <script src="{{asset('assets/lib/jquery-3.4.1.min.js',\App::environment() == 'production')}}" type="text/javascript"></script>
    <script src="{{asset('assets/lib/bootstrap/js/bootstrap.min.js',\App::environment() == 'production')}}" type="text/javascript"></script>
    <script src="{{asset('/assets/js/translations.js',\App::environment() == 'production')}}"></script>
    <script src="{{asset('assets/js/mainAdmin.js',\App::environment() == 'production')}}" type="text/javascript"></script>

    <!--Grafics-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    

</head>

<body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Townout</a>
        <ul class="navbar-nav px-3">

            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>
            </li>
        </ul>
        <ul id="languagesMenu" class="nav">
            <li class="nav-item"><a class="nav-link text-light" href="{{ route('change_lang',['lang'=>'en']) }}">En</a></li>
            <li class="nav-item"><a class="nav-link text-light" href="{{ url('lang/es') }}">Es</a></li>
            <li class="nav-item"><a class="nav-link text-light" href="{{ url('lang/eu')}}">Eu</a></li>
        </ul>
        <div class="d-block d-lg-none d-md-none m-1">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-center text-decoration-none text-light" id="mensajes" href="{{route('admin.admin')}}">
                        <i class="fa fa-md fa-envelope text-white"></i><span data-feather="home"></span>
                        @lang('admin.messages') <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-center text-decoration-none text-light" class="text-center  text-white" id="usuarios" href="{{route('admin.index')}}">
                        <i class="fas fa-md fa-users-cog  text-white"></i><span data-feather="file"></span>
                        @lang('admin.users')
                    </a>
                </li>
                <li class="nav-item" id="nuevoAdmin">
                    <a class="nav-link text-center text-decoration-none text-light" class="text-center text-white" href="{{route('admin.create')}}">
                        <i class="fas fa-plus text-white"></i><span data-feather="file"></span>
                        @lang('admin.newAdmin')
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-center text-decoration-none text-light" class="text-center text-white" id="stats" href="">
                        <i class="fa fa-chart-bar text-white"></i><span data-feather="shopping-cart"></span>
                        @lang('admin.stats')
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-center text-decoration-none text-light" id="ajustes" href="{{route('admin.show',Auth::user()->id)}}">
                        <i class="fas fa-wrench text-white"></i><span data-feather="users"></span>
                        @lang('admin.settings')
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-center text-decoration-none text-light" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i><span data-feather="users"></span>
                        @lang('admin.logOut')
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" id="mensajes" href="{{route('admin.admin')}}">
                                <i class="fa fa-md fa-envelope"></i><span data-feather="home"></span>
                                @lang('admin.messages') <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="usuarios" href="{{route('admin.index')}}">
                                <i class="fas fa-md fa-users-cog"></i><span data-feather="file"></span>
                                @lang('admin.users')
                            </a>
                        </li>
                        <li class="nav-item" id="nuevoAdmin">
                            <a class="nav-link" href="{{route('admin.create')}}">
                                <i class="fas fa-plus"></i><span data-feather="file"></span>
                                @lang('admin.newAdmin')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="stats" href="{{route('admin.stadistics')}}">
                                <i class="fa fa-chart-bar"></i><span data-feather="shopping-cart"></span>
                                @lang('admin.stats')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="ajustes" href="{{route('admin.show',Auth::user()->id)}}">
                                <i class="fas fa-wrench"></i><span data-feather="users"></span>
                                @lang('admin.settings')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i><span data-feather="users"></span>
                                @lang('admin.logOut')
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>

                </div>
            </nav>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" id="fondoAdmin">
                @yield('adminContent')
            </main>

        </div>
    </div>
</body>

</html>