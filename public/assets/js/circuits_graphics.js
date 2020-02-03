var request = new XMLHttpRequest();
var c_dates=[];
var c_cont=[];

$.get('http://127.0.0.1:8000/api/circuits',function([dates,cont],statusTxt){
	if(statusTxt === 'success'){
		console.log('success');
		dates = dates;
		cont = cont;

	}else{
		console.log('error');
	}
});

google.charts.load('current', {'packages':['line']});
google.charts.setOnLoadCallback(circuitsChart);

function circuitsChart(){
	var circuitsChartDiv = document.getElementById('circuits_chart');

	var data_c = new google.visualization.DataTable();
	data_c.addColumn('date','Fecha');
	data_c.addColumn('number','Nº Circuitos');

	for (let j = 0; j<dates.length; j++){
		data_c.addRows([
				[new Date(dates[j]),cont[j]],

			]);
	}

	var options_c = {
		chart: {
			title: 'Circuitos creados'
		},
		width: 900,
		height: 500
	};

	function drawCircuitsChart() {
		var circuitsChart = new google.charts.Line(circuitsChartDiv);
		circuitsChart.draw(data_c,options_c);
	}
	drawCircuitsChart();
}