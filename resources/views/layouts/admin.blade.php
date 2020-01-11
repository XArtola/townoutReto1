<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Control Panel</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('assets/css/dashboard.css')}}" rel="stylesheet">
    <link href="{{asset('assets/lib/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/fontawesome.css" rel="stylesheet">



    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
    <script src="{{asset('js/dashboard.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/lib/jquery-3.4.1.min.js')}}"></script>
    <script src="{{asset('assets/lib/bootstrap/js/bootstrap.min.js')}}"></script>
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
        <li><a class="nav-link" href="{{ route('change_lang',['lang'=>'en']) }}">En</a></li>
        <li><a class="nav-link" href="{{ url('lang/es') }}">Es</a></li>
        <li><a class="nav-link" href="{{ url('lang/eu')}}">Eu</a></li>

    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{route('admin.admin')}}">
                            <i class="fa fa-md fa-envelope"></i><span data-feather="home"></span>
                                Mensajes <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('admin.index')}}">
                               <i class="fa fa-md fa-users-cog"></i><span data-feather="file"></span>
                                Usuarios
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('admin.index')}}">
                               <i class="fas fa-plus"></i><span data-feather="file"></span>
                                Nuevo admin
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                            <i class="fa fa-chart-bar"></i><span data-feather="shopping-cart"></span>
                                Estadísticas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                            <i class="fas fa-chart-wrench"></i><span data-feather="users"></span>
                                Settings
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                           <span data-feather="users" ></span>
                                Salir
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