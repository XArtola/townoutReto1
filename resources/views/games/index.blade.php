<!DOCTYPE html>
<html>

<head>
    <title>{{$game->circuit->name}}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximumscale=1.0" />
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin="" />
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/css/game.css',\App::environment() == 'production')}}">
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <style>
        * {
            padding: 0;
            margin: 0
        }
    </style>
    <script>
        //Para poder cargar imgs desde el lado cliente
        var base_url = "{{asset('/',\App::environment() == 'production')}}";
    </script>
</head>

<body>
    <input type="hidden" name="acces" id="acces" value="{{Auth()->user()->api_token}}">
    <button id="switchDistance" style="position:fixed; top:5vh; left:5vw; z-index:600">SwitchDistance</button>
    <div id="mapid"></div>
    <a class="exit-btn" href="{{route('games.exit',['game'=>$game->id])}}">Terminar partida</a>
    <input type="hidden" id="game_id" value="{{$game->id}}">
    <input id="href" type="hidden" name="href" value="{{route('games.show',['id'=>$game->id])}}">
    @include('stages.show')
    <script type="text/javascript">
        $(function() {
                let game = {};
                let stage = null;
                let posActual = 0;
                let ready = false;
                let posiciones = [];
                let circuit = null;
                let distanciaMin = 20;
                let fails = 0;
                let stages = null;
                let distancia = null;
                let circle = null;
                let mymap = null;


                $('#switchDistance').click(function() {

                    if (distanciaMin == 20) {
                        distanciaMin = 20000;
                        alert('La distancia es ' + distanciaMin);
                    } else {
                        distanciaMin = 20;
                        alert('La distancia es ' + distanciaMin);
                    }

                });

                $.ajax({
                    url: base_url + 'api/games/' + $('#game_id').val() + '/get',
                    crossDomain: true,
                    headers: {
                        'Authorization': `Bearer ` + $('#acces').val(),
                    },
                    success: function(response) {
                        game = response['data'];
                        posActual = game['phase'];
                        getCircuit(game['circuit_id']);
                            
                    },
                    error: function(request, status, error) {
                        console.log('Error. No se ha podido obtener la información de circuito: ' + request.responseText + " | " + error);
                    },

                });

                $('#check').click(function() {
                    switch (stage.stage_type) {
                        case 'quiz':

                            if ($("input[name='quiz']:checked").val()) {
                                if ($("input[name='quiz']:checked").attr('data-answer') != stage.correct_ans) {
                                    $("input[name='quiz']:checked").css({
                                        'backgroundColor': 'red'
                                    });

                                    fails++
                                    alert('Respueste incorrecta')

                                } else {
                                    switch (fails) {

                                        case 0:
                                            game.score = game.score + 2;
                                            break;
                                            let stages = null;
                                        case 1:
                                            game.score = game.score + 1;
                                            break;
                                        default:
                                            //Nada
                                            break;
                                    }
                                    fails = 0;
                                    changeStage();
                                }

                            }

                            break;
                        default: //text
                            let completedWord = true;
                            $('.letter').each(function() {
                                if (!$(this).val() && !$(this).hasClass('whitespace')) {
                                    completedWord = false;
                                    $(this).css('borderColor', 'tomato')
                                } else $(this).css('borderColor', '#7d7d7d')
                            })
                            if (completedWord) {
                                let correct_word = true;
                                for (let i = 0; i < $('.letter').length; i++) {
                                    if ($('.letter')[i].value) {
                                        if ($('.letter')[i].value.toLowerCase() != stage.answer.charAt(i).toLowerCase()) {
                                            $(this).css('borderColor', 'tomato')
                                            correct_word = false;
                                        } else {
                                            $(this).css('borderColor', '#7d7d7d')
                                        }

                                    }
                                }
                                if (correct_word) {
                                    switch (fails) {

                                        case 0:
                                            game.score = game.score + 2;
                                            break;
                                        case 1:
                                            game.score = game.score + 1;
                                            break;
                                        default:
                                            //Nada
                                            break;
                                    }
                                    fails = 0;
                                    changeStage();
                                }else{
                                    if(fails < 2) fails++;
                                    alert('@lang('games.incorrect')')
                                }
                            } else if (fails < 2) {
                                fails++;
                                correct_word = false;
                                alert('@lang('games.incorrect')');
                            }

                            break;
                    }

                });

                getCircuit = (circuit_id) => {
                    $.ajax({
                        url: base_url + 'api/circuits/' + circuit_id,
                        crossDomain: true,
                        headers: {
                            'Authorization': `Bearer ` + $('#acces').val(),
                        },
                        success: function(response) {

                            circuit = response.data;

                            stages = response.data.stages;
                            for (x in response.data.stages)
                                posiciones.push([parseFloat(response.data.stages[x].lat), parseFloat(response.data.stages[x].lng)])

                            stage = response.data.stages[posActual];

                            startGame()
                            renderStage()

                        },
                        error: function(request, status, error) {
                            console.log('Error. No se ha podido obtener la información de circuito: ' + request.responseText + " | " + error);
                        },

                    });
                }

                let renderStage = () => {
                    if (stages[posActual].question_text)
                        $('#stage .stage-question .stage-title').text(stages[posActual].question_text);
                    else
                        $('#stage .stage-question .stage-title').text("");
                    if (stages[posActual].question_image)
                        $('#stage .stage-question .stage-image').attr('src', stages[posActual].question_image);
                    else{
                        $('#stage .stage-question .stage-image').attr('src', '');
                        $('#stage .stage-question .stage-image').hide();
                    }

                    switch (stages[posActual].stage_type) {
                        case 'quiz':
                            $('#stage .stage-answer').empty();
                            $('#stage .stage-answer').css({'flexDirection':'column'})
                            //He añadido esto para arreglar parte del problema
                            $('#stage .stage-answer').append('<div>');
                            $('#stage .stage-answer').append(
                                `<div class="row quiz-option">
                                    <div class="quiz-circle"></div>
                                    <input type="radio" name="quiz" data-answer="` + stages[posActual].correct_ans + `">
                                    <label>` + stages[posActual].correct_ans + `</label>
                                </div>`
                            );
                            $('#stage .stage-answer').append(
                                `<div class="row quiz-option">
                                    <div class="quiz-circle"></div>
                                    <input type="radio" name="quiz" data-answer="` + stages[posActual].possible_ans1 + `">
                                    <label>` + stages[posActual].possible_ans1 + `</label>
                                </div>`
                            );
                            $('#stage .stage-answer').append(
                                `<div class="row quiz-option">
                                    <div class="quiz-circle"></div>
                                    <input type="radio" name="quiz" data-answer="` + stages[posActual].possible_ans2 + `">
                                    <label>` + stages[posActual].possible_ans2 + `</label>
                                </div>`
                            );
                            if (stages[posActual].possible_ans3)
                                $('#stage .stage-answer').append(
                                    `<div class="row quiz-option">
                                        <div class="quiz-circle"></div>
                                        <input type="radio" name="quiz" data-answer="` + stages[posActual].possible_ans3 + `">
                                        <label>` + stages[posActual].possible_ans3 + `</label>
                                    </div>`
                                );

                            $('.stage-answer').html($(".stage-answer > div.row").sort(function() {
                                return Math.random() - 0.5;
                            }));
                            $('#stage .stage-answer').append('<div>');

                            break;
                        case 'image':
                            //console.log('image')
                            // ----------------------------------
                            break;
                        default: //text
                            $('#stage .stage-answer').empty();
                            for (let i = 0; i < stages[posActual].answer.length; i++)
                                if (stages[posActual].answer.charAt(i) !== ' ') {
                                    $('#stage .stage-answer').append(
                                        `<input name="letter` + i + `" pattern="[A-Za-z0-9ñÑáéíóúÁÉÍÓÚ]{1}" maxlength="1" minlength="1" type="text" class="letter">`
                                    );
                                } else {
                                    $('#stage .stage-answer').append(
                                        '<div class="letter whitespace"></div>'
                                    );
                                }
                            break;
                    }
                }

                startGame = () => {


                    //FUNCIÓN DE GUARDADO DE POSICIONES

                    let savePos = (latlng) => {
                        let coords = {
                            "game_id": game['id'],
                            "lat": latlng.latitude,
                            "lng": latlng.longitude
                        }

                        //Conversión de objeto a JSON
                        let location = JSON.stringify(coords);

                        //Hacer la petición, para ello pasar parametros de configuración
                        $.ajax({
                            url: base_url + "api/locations",
                            type: "POST",
                            headers: {
                                'Authorization': `Bearer ` + $('#acces').val(),
                            },
                            data: location,
                            contentType: "application/json; charset=utf-8",
                            dataType: "json",
                            success: function(response, textStatus, jqXHR) {
                                console.dir(response);
                                @if($game->circuit->caretaker)
                                    if(!response.data.active_circuit){
                                        alert('@lang('games.force_finish')');
                                        window.location.href = "{{route('games.exit',['game'=>$game->id])}}";
                                    }
                                @endif
                            },
                            error: function(request, status, error) {
                                console.warn('Error: ' + request.responseText + " | " + error);
                            },

                        });

                    }

                    //Coordenadas actuales del jugador
                    let latlng = 0;
                    //Marcador del jugador
                    let marker = 0;
                    //Marker verde que muestran las fases superadas
                    let greenIcon = L.icon({
                        iconUrl: base_url + 'assets/img/map/marker-iconGreen.png',
                        //shadowUrl: 'leaf-shadow.png',

                        iconSize: [25, 41], // size of the icon
                        shadowSize: [50, 64], // size of the shadow
                        //iconAnchor[0]=La mitad de iconSize[0] iconAnchor[1]=iconSize[1]
                        iconAnchor: [12.5, 41], // point of the icon which will correspond to marker's location
                        shadowAnchor: [4, 62], // the same for the shadow
                        popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
                    });

                    mymap = L.map('mapid').locate({
                        watch: true,
                        enableHighAccuracy: true,
                        maximunAge: 3000,
                        timeout: 2000
                    });

                    function renderMap() {
                        //Aplicar capa al mapa 
                        L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
                            maxZoom: 100,
                            id: 'mapbox.streets',
                            accessToken: 'pk.eyJ1IjoiYmJyb29rMTU0IiwiYSI6ImNpcXN3dnJrdDAwMGNmd250bjhvZXpnbWsifQ.Nf9Zkfchos577IanoKMoYQ'
                        }).addTo(mymap);

                        mymap.setView(latlng, 17);
                        savePos(latlng);

                        marker = L.marker(latlng).addTo(mymap);

                        //Círculo que muestra el objetivo
                        circle = L.circle(posiciones[posActual], {
                            color: 'red',
                            fillColor: '#f03',
                            fillOpacity: 0.5,
                            radius: 75
                        }).addTo(mymap);
                    }

                    let firstLocation = true;

                    //Evento onlocationfound (cada vez que la posición se actualice)
                    mymap.on('locationfound', function(data) {

                        if (firstLocation) {
                            latlng = [data.latitude, data.longitude];
                            firstLocation = false;
                            renderMap();

                            for (let i = 0; i < game['phase']; i++) {

                                //Marker verde que muestran las fases superadas
                                let greenIcon = L.icon({
                                    iconUrl: base_url + 'assets/img/map/marker-iconGreen.png',
                                    //shadowUrl: 'leaf-shadow.png',

                                    iconSize: [25, 41], // size of the icon
                                    shadowSize: [50, 64], // size of the shadow
                                    //iconAnchor[0]=La mitad de iconSize[0] iconAnchor[1]=iconSize[1]
                                    iconAnchor: [12.5, 41], // point of the icon which will correspond to marker's location
                                    shadowAnchor: [4, 62], // the same for the shadow
                                    popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
                                });
                                L.marker(stages[i], {
                                    icon: greenIcon
                                }).addTo(mymap);

                            }

                        }

                        //Actualizar marcador
                        marker.setLatLng(data.latlng);
                        // Diferencia respecto de la posición anterior
                        let diff = L.latLng(latlng).distanceTo(data.latlng);

                        //Distancia hasta la próxima fase
                        distancia = marker.getLatLng().distanceTo(circle.getLatLng());
                        if (diff >= 2 || distancia < distanciaMin) {

                            //Info de la posición y distancia hasta proxima fase
                            let infoPos = "Posición: " + data.latlng + " Distacia a punto: " + distancia + "m ";

                            //Guardar nueva posición (Puede que haya que cambiarlo para actulizar cada vez y no cuando es mas de 5)
                            latlng = data.latlng;

                            savePos(data);

                            //Activa la prueba
                            if (distancia < distanciaMin)
                                $('#stage').css('display', 'flex');
                        }

                    });

                }

                //Marker verde que muestran las fases superadas
                let greenIcon = L.icon({
                    iconUrl: base_url + 'assets/img/map/marker-iconGreen.png',
                    //shadowUrl: 'leaf-shadow.png',

                    iconSize: [25, 41], // size of the icon
                    shadowSize: [50, 64], // size of the shadow
                    //iconAnchor[0]=La mitad de iconSize[0] iconAnchor[1]=iconSize[1]
                    iconAnchor: [12.5, 41], // point of the icon which will correspond to marker's location
                    shadowAnchor: [4, 62], // the same for the shadow
                    popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
                });

                let changeStage = () => {
                    L.marker(circle.getLatLng(), {
                        icon: greenIcon
                    }).addTo(mymap);

                    $('#stage').fadeOut(500);

                    if (posActual < posiciones.length - 1) {
                        posActual++;
                        stage = stages[posActual];
                        circle.setLatLng(posiciones[posActual]);

                        //Actualizar juego en la bd
                        game['phase'] = game['phase'] + 1;
                        $.ajax({
                            url: base_url + 'api/games/' + game['game_id'],
                            crossDomain: true,
                            type: "PUT",
                            headers: {
                                'Authorization': `Bearer ` + $('#acces').val(),
                            },
                            data: JSON.stringify(game),
                            contentType: "application/json; charset=utf-8",
                            dataType: "json",
                            success: function(response) {
                                renderStage()
                            },
                            error: function(request, status, error) {
                                console.log('Error. No se ha podido actualizar la información de game: ' + request.responseText + " | " + error);
                            },

                        });

                    } else { //FINISHING THE GAME
                        console.log('FINISH GAME')

                        L.marker(circle.getLatLng(), {
                            icon: greenIcon
                        }).addTo(mymap);

                        mymap.removeLayer(circle);
                        mymap.stopLocate();

                        alert('Finish, thanks for playing');

                        //Actualizar juego en la bd
                        game['phase'] = game['phase'] + 1;
                        game['finish_date'] = 'finished_game';

                        $.ajax({
                            url: base_url + 'api/games/' + game['game_id'],
                            crossDomain: true,
                            type: "PUT",
                            headers: {
                                'Authorization': `Bearer ` + $('#acces').val(),
                            },
                            data: JSON.stringify(game),
                            contentType: "application/json; charset=utf-8",
                            dataType: "json",
                            success: function(response) {
                                location.href = $('#href').val();
                            },
                            error: function(request, status, error) {
                                console.log('Error. No se ha podido actualizar la información de game: ' + request.responseText + " | " + error);
                            },

                        });
                    }

                }

            }

        );
    </script>

    <script>
        
        $(document).ready(function(){
            $('.stage-answer').on('click','.quiz-option',function(){
                console.log('asdf')

                // des-selecciona la que este seleccionada
                $('input[type=radio]').prop('checked',false);
                // quita la clase *-selected del que la tenga
                $('.quiz-option').removeClass('quiz-option-selected');
                $('.quiz-circle').removeClass('quiz-circle-selected');
                // selecciona el checkbox del elemento clickado y añade las clases necesarias
                $(this).find('input[type=radio]').prop('checked',true);
                $(this).addClass('quiz-option-selected');
                $(this).find('.quiz-circle').addClass('quiz-circle-selected');
            });
        })

    </script>

</body>

</html>