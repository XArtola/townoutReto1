@extends('layouts.user')
@section('title','Index')
@section('content')

<div class="row">
	<div class="col-lg-6 d-none d-md-block d-lg-block my-auto">
		<img class="col-10 mx-auto" src="{{asset('assets/img/logo.svg',\App::environment() == 'production')}}"></img>
	</div>
	<div class="col-lg-6 col-sm-12">
		<h1 class="display-4 lead text-center text-break">@lang('user.info')</h1>
		<p class="p-2 text-justify lead col-8 mx-auto">@lang('user.whatIsTownout')</p>
		<p class="pl-2 pb-2 pr-2 pt-0 text-justify lead col-8 mx-auto">@lang('user.whatIsTownout2')</p>
	</div>
	<div class="col-12 row">
		<h1 class="display-4 lead col-12 mt-4 p-2 ml-4 text-center text-break">@lang('user.howToPlay')</h1>
		<div class="col-lg-8 col-md-8 col-sm-12">
			<p class="pl-2 pt-2 pr-2 text-justify lead mx-auto col-8">@lang('user.howToPlayP1')</p>
			<p class="pl-2 pt-2 pr-2 text-justify lead mx-auto col-8">@lang('user.howToPlayP2')</p>
			<p class="pl-2 pt-2 pr-2 text-justify lead mx-auto col-8">@lang('user.howToPlayP3')</p>
			<p class="pl-2 pt-2 pr-2 text-justify lead mx-auto col-8">@lang('user.howToPlayP4')</p>
			<div class="mx-auto">
				<table class="table-responsive table-borderless col-8 mx-auto">
					<tr>
						<td class="font-weight-bold lead p-2">
							@lang('user.noFails')</td>
						<td class="text-center p-2">+2</td>
					</tr>
					<tr>
						<td class="font-weight-bold lead p-2">@lang('user.oneFail')</td>
						<td class="text-center p-2">+1</td>
					</tr>
					<tr>
						<td class="font-weight-bold lead p-2">@lang('user.manyFails')</td>
						<td class="text-center p-2">+0</td>
					</tr>
				</table>
			</div>
			<p class="pl-2 pt-2 pr-2 text-justify lead mx-auto col-8">@lang('user.howToPlayP5')</p>
		</div>
		<div class="col-lg-4 col-sm-12 mx-auto ms-sm-auto my-auto text-center">
			<img class="col-10 mx-auto img-fluid" src="{{asset('assets/img/mapaJuego.JPG',\App::environment() == 'production')}}"></img>
		</div>
		<!--Aqui pantallazo de games.show-->
	</div>
	<div class="col-12 row">
		<h1 class="display-4 lead col-12 mt-4 p-2 ml-4 text-center text-break">@lang('user.circuitTypes')</h1>
		<div class="col-lg-8 col-sm-12 mx-auto">
			<p class="pl-2 pt-2 pr-2 text-justify lead mx-auto col-12">@lang('user.circuitTypesP1')</p>
			<p class="pl-2 pt-2 pr-2 text-justify lead mx-auto col-12">@lang('user.circuitTypesP2')</p>
		</div>
	</div>
	<div class="col-12 row">
		<h1 class="display-4 lead col-12 mt-4 p-2 ml-4 text-center text-break">@lang('user.guide')</h1>
		<div class="col-lg-8 col-sm-12 mx-auto pb-2">
			<div class="row col-12 py-4 mx-auto">
				<div class="col-lg-6 col-sm-12 order-sm-2 mx-sm-auto order-lg-1 order-sm-2 order-2 text-center">
					<img class="col-10 mx-auto img-fluid" src="{{asset('assets/img/caretakerFormulario.JPG',\App::environment() == 'production')}}"></img>
				</div>

				<p class="col-lg-6 col-sm-12 order-sm-1 col-xs-12 order-lg-2 order-sm-1 order-1 pl-2 pt-2 pr-2 text-justify lead mx-auto">@lang('user.guideP1')</p>
			</div>

			<div class="row col-12 py-4">
				<p class="col-lg-6 col-md-6 col-12 pl-2 pt-2 pr-2 text-justify lead mx-auto my-auto">@lang('user.guideP2')</p>

				<div class="col-lg-6 col-md-6 col-12 text-center">
					<img class="col-10 mx-auto img-fluid" src="{{asset('assets/img/caretakerCircuito.JPG',\App::environment() == 'production')}}"></img>
				</div>
			</div>

		</div>
	</div>
	<!--Aqui pantallazo de monitoring-->


</div>
@endsection

@section('js')
$(document).ready(function(){
$('table form input[type="button"]').click(function(){
$(this).parent('form').submit();
});
});
@endsection