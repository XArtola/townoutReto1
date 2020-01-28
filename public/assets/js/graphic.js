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
              var c = cont.slice(-1).pop();
              cont.pop();
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

      //var button = document.getElementById('change-chart');
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