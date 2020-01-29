var request = new XMLHttpRequest();
var dates = [];
var cont = [];
var d;
var fecha;


$.get('http://127.0.0.1:8000/api/games', function(games, statusTxt){

  if(statusTxt =="success"){
    console.log('success');
    for(var game in games){

      d = new Date(games[game]['finish_date']);
      fecha = d.getFullYear()+'-'+'0'+(d.getMonth()+1)+'-'+d.getDate();

            //Si la fecha obtenida NO coincide con ninguna registrada en el array
            if(!dates.includes(fecha)){
              //Inserta la fecha en el array
              dates.push(fecha);
              //Inserta 1 en el array contador 
              cont.push(1);

            //Si la fecha obtenida SI existe en el array 
          }else{
              //Obtiene último dato del array contador.
              var c = cont.slice(-1).pop();
              //Elimina el último dato del array contador
              cont.pop();
              //Inserta en la última posición la variable del anterior último dato y le suma 1
              cont.push(c+1);

            }

          }

          console.log(dates);
          console.log(cont);

        }else
        console.log('error');


      });



google.charts.load('current', {'packages':['line']});
google.charts.setOnLoadCallback(gamesChart);

function gamesChart() {

  var chartDiv = document.getElementById('chart_div');

  var data = new google.visualization.DataTable();
  data.addColumn('date', 'Date');
  data.addColumn('number', "Totales");
  data.addColumn('number', "Estandar");
  data.addColumn('number', "Caretaker");


  for(var j = 0 ; j<dates.length; j++){
    data.addRows([
      [new Date(dates[j]), cont[j],0,0],

      ]);
  }

  var options = {
    chart: {
      title: 'Circuitos Jugados',

    },
    width: 900,
    height: 500
  };



  function drawGamesChart() {
    var gamesChart = new google.charts.Line(chartDiv);
    gamesChart.draw(data, options);

  }
  drawGamesChart();

}

//Circuitos

//var request = new XMLHttpRequest();
var c_dates=[];
var c_cont=[];
var c_caretaker=[];
var c_standard=[];

$.get('http://127.0.0.1:8000/api/circuits',function([dates,cont,caretaker,standard],statusTxt){
  if(statusTxt === 'success'){
    console.log('success');
    c_dates = dates;
    c_cont = cont;
    c_standard = standard;
    c_caretaker = caretaker;
    console.log(cont);
    console.log(c_caretaker);
    console.log(c_standard);

  }else{
    console.log('error');
  }
});

google.charts.setOnLoadCallback(circuitsChart);

function circuitsChart(){
  var circuitsChartDiv = document.getElementById('circuits_chart');

  var data_c = new google.visualization.DataTable();
  data_c.addColumn('date','Fecha');
  data_c.addColumn('number','Nº Circuitos');
  data_c.addColumn('number','Nº Circuitos Caretaker');
  data_c.addColumn('number','Nº Circuitos Estandar');

  for (let j = 0; j<c_dates.length; j++){
    data_c.addRows([
      [new Date(c_dates[j]),c_cont[j],c_caretaker[j],c_standard[j]],

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