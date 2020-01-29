@extends('layouts.admin')
@section('adminContent')

<script src="{{asset('/assets/js/graphic.js',\App::environment() == 'production')}}"></script>
<script src="{{asset('/assets/js/circuits_graphic.js',\App::environment() == 'production')}}"></script>

  <body>
  <!--<button id="change-chart">Change to Classic</button>
  	<br><br>-->
  	<div id="chart_div"></div>

    <div id="circuits_chart"></div>
  </body>



  @endsection