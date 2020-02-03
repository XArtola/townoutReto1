var request = new XMLHttpRequest();



/*              Partidas                */

//var request = new XMLHttpRequest();

//Array de las fechas para poder representarlas en la gráfica
var g_dates=[];
//Array contador de las partidas jugadas
var g_cont=[];
//Array contador de las partidas jugadas con caretaker
var g_caretaker=[];
//Array contador de los las partidas jugadas tipo standard
var g_standard=[];

$.get('http://127.0.0.1:8000/api/gamesgraphic',function([dates,cont,caretaker,standard],statusTxt){
  if(statusTxt === 'success'){
    console.log('success');
    g_dates = dates;
    g_cont = cont;
    g_standard = standard;
    g_caretaker = caretaker;
    console.log(cont);
    console.log(g_caretaker);
    console.log(g_standard);

  }else{
    console.log('error');
  }
});

google.charts.load('current', {'packages':['line']});
google.charts.setOnLoadCallback(gamesChart);

function gamesChart(){
  var gamesChartDiv = document.getElementById('games_chart');

  var data_g = new google.visualization.DataTable();
  data_g.addColumn('string','Fecha');
  data_g.addColumn('number','Nº partidas');
  data_g.addColumn('number','Nº partidas Caretaker');
  data_g.addColumn('number','Nº partidas Estandar');

  for (let j = 0; j<g_dates.length; j++){
    data_g.addRows([
      [g_dates[j],g_cont[j],g_caretaker[j],g_standard[j]],
      ]);
  }

  var options_g = {
    chart: {
      title: 'Partidas jugadas'
    },
    width: 900,
    height: 500,
    
  };

  function drawGamesChart() {
    var gamesChart = new google.charts.Line(gamesChartDiv);
    gamesChart.draw(data_g,options_g);
  }
  drawGamesChart();
}

/*              Circuitos                */

//var request = new XMLHttpRequest();

//Array de las fechas para poder representarlas en la gráfica
var c_dates=[];
//Array contador de los circuitos creados
var c_cont=[];
//Array contador de los circuitos creados con caretaker
var c_caretaker=[];
//Array contador de los circuitos creados tipo standard
var c_standard=[];

$.get('http://127.0.0.1:8000/api/circuitsgraphic',function([dates,cont,caretaker,standard],statusTxt){
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
  data_c.addColumn('string','Fecha');
  data_c.addColumn('number','Nº Circuitos');
  data_c.addColumn('number','Nº Circuitos Caretaker');
  data_c.addColumn('number','Nº Circuitos Estandar');

  for (let j = 0; j<c_dates.length; j++){
    data_c.addRows([
      [c_dates[j],c_cont[j],c_caretaker[j],c_standard[j]],
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


/*              Usuarios                */

//var request = new XMLHttpRequest();

//Array de las fechas para poder representarlas en la gráfica
var u_dates=[];
//Array contador de los usuarios registrados
var u_cont=[];


$.get('http://127.0.0.1:8000/api/usersgraphic',function([dates,cont],statusTxt){
  if(statusTxt === 'success'){
    console.log('success');
    u_dates = dates;
    u_cont = cont;
    console.log(dates);
    console.log(cont);

  }else{
    console.log('error');
  }
});


google.charts.setOnLoadCallback(usersChart);


function usersChart(){
  var usersChartDiv = document.getElementById('users_chart');

  var data_u = new google.visualization.DataTable();
  data_u.addColumn('string','Fecha');
  data_u.addColumn('number','Nº Usuarios');
  
  for (let j = 0; j<u_dates.length; j++){
    data_u.addRows([
      [u_dates[j],u_cont[j]],
      ]);
  }

  var options_u = {
    chart: {
      title: 'Usuarios registrados'
    },
    width: 900,
    height: 500
  };

  function drawUsersChart() {
    var usersChart = new google.charts.Line(usersChartDiv);
    usersChart.draw(data_u,options_u);
  }
  drawUsersChart();
}

