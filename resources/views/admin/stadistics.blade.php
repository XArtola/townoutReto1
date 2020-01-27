@extends('layouts.admin')
@section('adminContent')

<script type="text/javascript">

  var request = new XMLHttpRequest();
  var dates = [];
  var d;
  //console.log(request);

  $.get('http://127.0.0.1:8000/api/games', function(games, statusTxt){

    if(statusTxt =="success"){
      console.log('success');

      for(var game in games){
        for( var r in games[game]){
          if(r==="finish_date"){
            console.log(r+': '+games[game][r]);
            dates.push(games[game][r]);
            //console.log(typeof(games[game][r]));
            var cont=1;
            console.log(cont);
          }
          
        }
        console.log(dates[game]);

      }
                //console.log(dates);

              }else
              console.log('error');

            });

  google.charts.load('current', {'packages':['line', 'corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {

      //var button = document.getElementById('change-chart');
      var chartDiv = document.getElementById('chart_div');

      var data = new google.visualization.DataTable();
      data.addColumn('date', 'Fecha');
      data.addColumn('number', "Average Temperature");
      
      for(var j = 0 ; j<dates.length; j++){
        data.addRows([
          [new Date(dates[j]), 2],
          ]);
      }

      var materialOptions = {
      	chart: {
      		title: 'Gráfica de prueba'
      	},
      	width: 900,
      	height: 500,
      	series: {
          // Gives each series an axis name that matches the Y-axis below.
          0: {axis: 'Temps'},
          
        },
        axes: {
          // Adds labels to each axis; they don't have to match the axis names.
          y: {
          	Temps: {label: 'Nº of Played Games'}
          }
        }
      };



      function drawMaterialChart() {
        var materialChart = new google.charts.Line(chartDiv);
        materialChart.draw(data, materialOptions);

      }

      drawMaterialChart();

    }
  </script>

  <body>
  <!--<button id="change-chart">Change to Classic</button>
  	<br><br>-->
  	<div id="chart_div"></div>
  </body>



  @endsection