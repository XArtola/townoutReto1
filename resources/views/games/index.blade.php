<!DOCTYPE html>
<html>

<head>
    <title>Prueba mapas</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <style>
        * {
            padding: 0;
            margin: 0
        }
    </style>
    <script>
        //Para coger imgs desde JS
        var base_url = "{{asset('/')}}";
        console.log(base_url)
    </script>
</head>

<body>

    <div id="mapid" style="height:90vh; width:100vw"></div>
    <p id="distancia"></p>
    <input type="hidden" id="game_id" value="{{$id}}">
    <script type="text/javascript">
        $(function() {
                console.log("la id de juego es " + $('#game_id').val());
                let game = {};

                $.ajax({
                    url: 'http://localhost:8000/api/games/' + $('#game_id').val() + '/get',
                    crossDomain: true,
                    success: function(response) {

                        game = response['data'];
                        console.log('La info de juego es');
                        console.dir(game['circuit_id']);
                        getCircuit(game['circuit_id']);

                    },
                    error: function(request, status, error) {
                        console.log('Error. No se ha podido obtener la información de circuito: ' + request.responseText + " | " + error);
                    },

                });


                let ready = false;


                //Posiciones (luego se reciben de la API)			
                let posiciones = [
                    /*
                    [43.270764744756164, -2.020127177238465],
                    [43.27366679940051, -2.0200037956237797]
                    */
                    /*[43.272639573807616, -2.0209318399429326],
                    [43.27072959115984, -2.0201379060745244],
                    [43.26810473194478, -2.0226001739501958],
                    [43.26701881958545, -2.021720409393311]*/
                    /*
				[43.32033843655583, -1.9799369573593142],
				[43.327320092886154, -1.9708174467086794]*/

                ];

                getCircuit = (circuit_id) => {
                    $.ajax({
                        url: 'http://localhost:8000/api/circuits/' + circuit_id,
                        crossDomain: true,
                        success: function(response) {
                            console.log('la respuesta circuito es')
                            console.dir(response);
                            for (x in response.data.stages)
                                posiciones.push([parseFloat(response.data.stages[x].lat), parseFloat(response.data.stages[x].lng)])

                            startGame()

                        },
                        error: function(request, status, error) {
                            console.log('Error. No se ha podido obtener la información de circuito: ' + request.responseText + " | " + error);
                        },

                    });
                }
                startGame = () => {

                    console.log(posiciones)
                    //Posición en el array de coordenadas
                    let posActual = 0;

                    //FUNCIÓN DE GUARDADO DE POSICIONES

                    savePos = (data) => {
                        let coords = {
                            "game_id": game['id'],
                            "lat": data.latlng.lat,
                            "lng": data.latlng.lng
                        }

                        //Conversión de objeto a JSON
                        let location = JSON.stringify(coords);

                        //Hacer la petición, para ello pasar parametros de configuración
                        $.ajax({
                            url: "http://localhost:8000/api/locations",
                            type: "POST",
                            data: location,
                            contentType: "application/json; charset=utf-8",
                            dataType: "json",
                            success: function(data, textStatus, jqXHR) {
                                console.dir(data)
                            },
                            error: function(request, status, error) {
                                console.log('Error: ' + request.responseText + " | " + error);
                            },

                        });

                    }

                    //Coordenadas actuales del jugador
                    let latlng = 0;
                    //Marcador derl jugador
                    let marker = 0;
                    //Marker verde que muestran las fases superadas
                    let greenIcon = L.icon({
                        iconUrl: base_url+'assets/img/map/marker-iconGreen.png',
                        //shadowUrl: 'leaf-shadow.png',

                        iconSize: [25, 41], // size of the icon
                        shadowSize: [50, 64], // size of the shadow
                        //iconAnchor[0]=La mitad de iconSize[0] iconAnchor[1]=iconSize[1]
                        iconAnchor: [12.5, 41], // point of the icon which will correspond to marker's location
                        shadowAnchor: [4, 62], // the same for the shadow
                        popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
                    });

                    //latlng = new L.LatLng(location.coords.latitude, location.coords.longitude);

                    var mymap = L.map('mapid').locate({
                        watch: true,
                        //enableHighAccuracy: true,
                        maximunAge: 3000,
                        timeout: 2000
                    });

                    //Círculo que muestra el objetivo
                    var circle = L.circle(posiciones[0], {
                        color: 'red',
                        fillColor: '#f03',
                        fillOpacity: 0.5,
                        radius: 75
                    }).addTo(mymap);

                    //Aplicar capa al mapa 
                    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
                        attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://mapbox.com">Mapbox</a>',
                        maxZoom: 100,
                        id: 'mapbox.streets',
                        accessToken: 'pk.eyJ1IjoiYmJyb29rMTU0IiwiYSI6ImNpcXN3dnJrdDAwMGNmd250bjhvZXpnbWsifQ.Nf9Zkfchos577IanoKMoYQ'
                    }).addTo(mymap);

                    //Evento onlocationfound (cada vez que la posición se actualice)
                    mymap.on('locationfound', function(data) {
                        //La primera vez guardar el valor directamente
                        if (latlng === 0) {
                            latlng = data.latlng;
                            mymap.setView(latlng, 30).setZoom(20);
                            marker = L.marker(latlng).addTo(mymap);
                            savePos(data);
                        } else {

                            //Actualizar marcador
                            marker.setLatLng(data.latlng);

                            // Diferencia respecto de la posición anterior
                            let diff = latlng.distanceTo(data.latlng);

                            //Distancia hasta la próxima fase
                            let distancia = marker.getLatLng().distanceTo(circle.getLatLng());
                            //console.log(distancia);
                            //console.log('la diferencia es de '+diff+' metros')
                            if (diff >= 2 || distancia < 2000000) {

                                //Info de la posición y distancia hasta proxima fase
                                let infoPos = "Posición: " + data.latlng + " Distacia a punto: " + distancia + "m ";

                                //Guardar nueva posición (Puede que haya que cambiarlo para actulizar cada vez y no cuando es mas de 5)
                                latlng = data.latlng;

                                savePos(data);

                                document.getElementById('distancia').innerHTML = infoPos;

                                //Cambiar el marcador de la siguiente fase
                                if (distancia < 200000) {

                                    //alert('Has llegado, busca el siguiente');
                                    L.marker(circle.getLatLng(), {
                                        icon: greenIcon
                                    }).addTo(mymap);

                                    if (posActual < posiciones.length - 1) {
                                        posActual++;
                                        circle.setLatLng(posiciones[posActual]);
                                        alert('Has llegado, busca el siguiente');

                                        //Actualizar juego en la bd
                                        game['phase'] = game['phase'] + 1;
                                        $.ajax({
                                            url: 'http://localhost:8000/api/games/' + game['game_id'],
                                            crossDomain: true,
                                            type: "PUT",
                                            data: JSON.stringify(game),
                                            contentType: "application/json; charset=utf-8",
                                            dataType: "json",
                                            success: function(response) {
                                                console.log('la respuesta del juego actualizado es')
                                                console.dir(response);
                                            },
                                            error: function(request, status, error) {
                                                console.log('Error. No se ha podido actualizar la información de game: ' + request.responseText + " | " + error);
                                            },

                                        });

                                    } else {
                                        L.marker(circle.getLatLng(), {
                                            icon: greenIcon
                                        }).addTo(mymap);
                                        mymap.removeLayer(circle);
                                        mymap.stopLocate();
                                        alert('Finish, thanks for playing');

                                        //Actualizar juego en la bd
                                        game['phase'] = game['phase'] + 1;
                                        game['finish_date'] = 'asds';
                                        $.ajax({
                                            url: 'http://localhost:8000/api/games/' + game['game_id'],
                                            crossDomain: true,
                                            type: "PUT",
                                            data: JSON.stringify(game),
                                            contentType: "application/json; charset=utf-8",
                                            dataType: "json",
                                            success: function(response) {
                                                console.log('la respuesta del juego actualizado es')
                                                console.dir(response);
                                            },
                                            error: function(request, status, error) {
                                                console.log('Error. No se ha podido actualizar la información de game: ' + request.responseText + " | " + error);
                                            },

                                        });
                                    }

                                }

                            }
                        }

                    });


                }

            }

        );
    </script>

</body>

</html>