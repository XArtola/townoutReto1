@extends('layouts.admin')
@section('adminContent')
<h1 class="lead text-uppercase col-12">@lang('admin.graphics')</h1>


 <div class="col-12" id="games_chart"></div>

 <div class="col-12" id="circuits_chart"></div>

 <div class="col-12" id="users_chart"></div>

<script src="{{asset('/assets/js/graphic.js',\App::environment() == 'production')}}"></script>



@endsection