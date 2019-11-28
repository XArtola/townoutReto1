<html lang="{{ app()->getLocale() }}">
  <head>
    <title>Idiomas townout</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  </head>
  <body>
 
    <nav class="navbar navbar-default container">
      <div class="container-fluid">
      <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="{{ route('change_lang',['lang'=>'en']) }}">En</a></li>
            <li><a href="{{ url('lang/es') }}">Es</a></li>
            <li><a href="{{ url('lang/eu')}}">Eu</a></li>
          </ul>
        </div>
      </div>
    </nav>
 
    <div class="jumbotron container">
      <!-- Diferentes formas de llamar a lang-->
        <p>{{trans('welcome.home')}}</p>
        <p>@lang('welcome.description')</p>
    </div>
 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>