@extends('layouts.admin')
@section('adminContent')


<body>

 <div id="chart_div"></div>

 <div id="circuits_chart"></div>
</body>

<script src="{{asset('/assets/js/graphic.js',\App::environment() == 'production')}}"></script>



@endsection