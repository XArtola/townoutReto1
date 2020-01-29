var request = new XMLHttpRequest();

$.get('http://127.0.0.1:8000/api/circuits',function(circuits,statusTxt){
	if(statusTxt === 'success'){
		console.log('success');

	}else{
		console.log('error');
	}
});

google.charts.load('current'{'packages':['line']});
google.charts.setOnLoadCallback(circuitsChart);

function circuitsChart(){
	var circuitsChartDiv = document.getElementById('circuits_chart');

	var data_c = new google.visualization.DataTable();
	data_c.addColumn('date','Fecha');
	data_c.addColumn('number','Nº Circuitos');

	for (let j = 0; j<)
}