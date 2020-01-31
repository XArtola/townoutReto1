@extends('layouts.admin')
@section('adminContent')


<body>

 <div id="games_chart"></div>

 <div id="circuits_chart"></div>

 <div id="users_chart"></div>
</body>

<script src="{{asset('/assets/js/graphic.js',\App::environment() == 'production')}}"></script>



@endsection