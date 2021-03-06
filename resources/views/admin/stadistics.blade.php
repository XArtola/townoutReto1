@extends('layouts.admin')
@section('title') @lang('admin.stats') @endsection
@section('script')
<!--Grafics-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

@endsection
@section('adminContent')

<input type="hidden" name="acces" id="acces" value="{{Auth()->user()->api_token}}">

<div class="row">
	<h1 class="lead text-uppercase col-12 text-left mx-auto">@lang('admin.graphics')</h1>
</div>

<div class="row">
	<div class="col-11 crart mx-auto mb-3" id="games_chart"></div>

	<div class="col-11 mx-auto mb-3" id="circuits_chart"></div>

	<div class="col-11 mx-auto mb-3" id="users_chart"></div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		google.charts.load('current', {
			'packages': ['line'], 'callback':drawCharts
		});

		function drawCharts(){

		

			/*              Partidas                */

			//Array de las fechas para poder representarlas en la gráfica
			var g_dates = [];
			//Array contador de las partidas jugadas
			var g_cont = [];
			//Array contador de las partidas jugadas con caretaker
			var g_caretaker = [];
			//Array contador de los las partidas jugadas tipo standard
			var g_standard = [];

			$.ajax({
				method: 'GET',
				url: base_url + 'api/gamesgraphic',
				crossDomain: true,
				headers: {
					'Authorization': `Bearer ` + $('#acces').val(),
				},
				success: function([dates, cont, caretaker, standard]) {

					g_dates = dates;
					g_cont = cont;
					g_standard = standard;
					g_caretaker = caretaker;

					
					google.charts.setOnLoadCallback(gamesChart);
					gamesChart();
					
				},
				error: function(request, status, error) {
					console.log('Error. No se ha podido obtener la información de las partidas: ' + request.responseText + " | " + error);
				},

			});



			function gamesChart() {
				var gamesChartDiv = document.getElementById('games_chart');

				var data_g = new google.visualization.DataTable();
				data_g.addColumn('string', 'Fecha');
				data_g.addColumn('number', 'Nº partidas');
				data_g.addColumn('number', 'Nº partidas Caretaker');
				data_g.addColumn('number', 'Nº partidas Estandar');

				for (let j = 0; j < g_dates.length; j++) {
					data_g.addRows([
						[g_dates[j], g_cont[j], g_caretaker[j], g_standard[j]],
					]);
				}

				var options_g = {
					chart: {
						title: 'Partidas jugadas'
					},
					vAxis: {
						minValue: 0
					},
					width: '100%',
					height: 500,

				};

				var gamesChart = new google.charts.Line(gamesChartDiv);
				gamesChart.draw(data_g, options_g);

				// Quita los errores que aparcen al hacer cambio de tamaño de forma manual
				google.visualization.events.addListener(gamesChart, 'error', function(googleError) {
					google.visualization.errors.removeError(googleError.id);
				});

			}

			/*              Circuitos                */

			//Array de las fechas para poder representarlas en la gráfica
			var c_dates = [];
			//Array contador de los circuitos creados
			var c_cont = [];
			//Array contador de los circuitos creados con caretaker
			var c_caretaker = [];
			//Array contador de los circuitos creados tipo standard
			var c_standard = [];

			$.ajax({
				method: 'GET',
				url: base_url + 'api/circuitsgraphic',
				crossDomain: true,
				headers: {
					'Authorization': `Bearer ` + $('#acces').val(),
				},
				success: function([dates, cont, caretaker, standard]) {

					c_dates = dates;
					c_cont = cont;
					c_standard = standard;
					c_caretaker = caretaker;

				
	google.charts.setOnLoadCallback(circuitsChart);


	circuitsChart();
				},
				error: function(request, status, error) {
					console.log('Error. No se ha podido obtener la información de los circuitos: ' + request.responseText + " | " + error);
				},

			});


			function circuitsChart() {
				var circuitsChartDiv = document.getElementById('circuits_chart');

				var data_c = new google.visualization.DataTable();
				data_c.addColumn('string', 'Fecha');
				data_c.addColumn('number', 'Nº Circuitos');
				data_c.addColumn('number', 'Nº Circuitos Caretaker');
				data_c.addColumn('number', 'Nº Circuitos Estandar');

				for (let j = 0; j < c_dates.length; j++) {
					data_c.addRows([
						[c_dates[j], c_cont[j], c_caretaker[j], c_standard[j]],
					]);
				}

				var options_c = {
					chart: {
						title: 'Circuitos creados'
					},
					width: '100%',
					height: 500
				};

				var circuitsChart = new google.charts.Line(circuitsChartDiv);
				circuitsChart.draw(data_c, options_c);

				// Quita los errores que aparcen al hacer cambio de tamaño de forma manual
				google.visualization.events.addListener(circuitsChart, 'error', function(googleError) {
					google.visualization.errors.removeError(googleError.id);
				});


			}

			/*              Usuarios                */

			//var request = new XMLHttpRequest();

			//Array de las fechas para poder representarlas en la gráfica
			var u_dates = [];
			//Array contador de los usuarios registrados
			var u_cont = [];

			$.ajax({
				method: 'GET',
				url: base_url + 'api/usersgraphic',
				crossDomain: true,
				headers: {
					'Authorization': `Bearer ` + $('#acces').val(),
				},
				success: function([dates, cont]) {

					u_dates = dates;
					u_cont = cont;

					google.charts.setOnLoadCallback(usersChart);

					usersChart();

				},
				error: function(request, status, error) {
					console.log('Error. No se ha podido obtener la información de usuarios: ' + request.responseText + " | " + error);
				},

			});


			function usersChart() {
				var usersChartDiv = document.getElementById('users_chart');

				var data_u = new google.visualization.DataTable();
				data_u.addColumn('string', 'Fecha');
				data_u.addColumn('number', 'Nº Usuarios');

				for (let j = 0; j < u_dates.length; j++) {
					data_u.addRows([
						[u_dates[j], u_cont[j]],
					]);
				}

				var options_u = {
					chart: {
						title: 'Usuarios registrados'
					},
					width: '100%',
					height: 500
				};

				var usersChart = new google.charts.Line(usersChartDiv);
				usersChart.draw(data_u, options_u);

				// Quita los errores que aparcen al hacer cambio de tamaño de forma manual
				google.visualization.events.addListener(usersChart, 'error', function(googleError) {
					google.visualization.errors.removeError(googleError.id);
				});

			}

			$(window).resize(function() {
				gamesChart();
				circuitsChart();
				usersChart();
			});

		
		}

		
	});
</script>
<style type="text/css">
	.chart {
		width: 100%;
		min-height: 450px;
	}
</style>
@endsection