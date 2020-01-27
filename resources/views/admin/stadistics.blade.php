@extends('layouts.admin')
@section('adminContent')

<script type="text/javascript">
  
  var request = new XMLHttpRequest();

  //console.log(request);

  $.get('http://127.0.0.1:8000/api/games', function(data, statusTxt){
        
        if(statusTxt =="success"){
          console.log('success');
          var dates = [];
          for(var i in data){

            for( var x in data[i]){
             

              if(x==="finish_date"){
                //console.log(x+': '+data[i][x]);
                dates.push(data[i][x]);
              }

            }
            //console.log(dates[i]);

          }
          console.log(dates);



        }
        
        else
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
      

      data.addRows([
      	[new Date(2014, 0),   1],
      	[new Date(2015, 0),   8],
      	[new Date(2016, 0),   5],
      	[new Date(2017, 0),   5],
      	[new Date(2018, 0),   5]

      	]);

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