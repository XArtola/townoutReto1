<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Townout</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="{{asset('/css/styles.css')}}">

        <!-- Libraries -->
        <script src="{{asset('/lib/jquery-3.4.1.min.js')}}"></script>

        <!-- Scripts -->
        <script src="{{asset('/js/main.js')}}"></script>
        <script src="{{asset('/js/animations.js')}}"></script>
    </head>
    <body>
        <nav>
            <img id="menuToggle" src="{{asset('/img/icons/menu.svg')}}">
            <ul>
                <li><a href="#contacto" class="same-page-nav" >Contacto</a></li>
            </ul>
        </nav>
        <header id="header">
            <!-- LOGO IMAGE SVG PATH -->
            <div id="logo">
                <svg class="scaledsvg" width="322" height="82" xmlns="http://www.w3.org/2000/svg">
                 <!-- Created with Method Draw - http://github.com/duopixel/Method-Draw/ -->
                 <defs>
                  <filter height="200%" width="200%" y="-50%" x="-50%" id="svg_2_blur">
                   <feGaussianBlur stdDeviation="0" in="SourceGraphic"/>
                  </filter>
                 </defs>
                 <g>
                  <title>background</title>
                  <rect fill="none" id="canvas_background" height="84" width="324" y="-1" x="-1"/>
                  <g display="none" overflow="visible" y="0" x="0" height="100%" width="100%" id="canvasGrid">
                   <rect fill="url(#gridpattern)" stroke-width="0" y="1" x="1" height="400" width="420"/>
                  </g>
                 </g>
                 <g>
                  <title>Layer 1</title>
                  <text xml:space="preserve" text-anchor="start" font-family="'Courier New', Courier, monospace" font-size="76" id="svg_1" y="60.207229" x="0.926229" stroke-width="0" stroke="#2b2b2b" fill="#2b2b2b">town</text>
                  <ellipse id="brujula-circulo" stroke="#2b2b2b" filter="url(#svg_2_blur)" ry="21.621554" rx="20.621554" id="svg_2" cy="40.583169" cx="205.797156" stroke-width="3.5" fill="none"/>
                  <ellipse stroke="#2b2b2b" ry="2.994792" rx="2.994792" id="svg_3" cy="40.811395" cx="205.823514" stroke-opacity="null" stroke-width="0" fill="#2b2b2b"/>
                  <path id="brujula" d="m201.48516,40.787704l4.260656,-12.40602l4.260656,12.40602l-4.260656,12.40602l-4.260656,-12.40602z" fill-opacity="null" stroke-opacity="null" stroke-width="NaN" stroke="#2b2b2b" fill="none"/>
                  <text xml:space="preserve" text-anchor="start" font-family="'Courier New', Courier, monospace" font-size="76" id="svg_18" y="60.708482" x="226.239507" stroke-width="0" stroke="#2b2b2b" fill="#2b2b2b">ut</text>
                 </g>
                </svg>
            </div>
            <div id="mobile">
                <img src="{{asset('/img/mobile.png')}}">
            </div>
            <!-- PLACEMARKS PARA ANIMACIÓN-->
            <svg id="pm0" class="placemarks" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 255.856 255.856" xml:space="preserve">
                <g>
                    <path style="fill:#bd2830" d="M127.928,38.8c-30.75,0-55.768,25.017-55.768,55.767s25.018,55.767,55.768,55.767
                        s55.768-25.017,55.768-55.767S158.678,38.8,127.928,38.8z M127.928,135.333c-22.479,0-40.768-18.288-40.768-40.767
                        S105.449,53.8,127.928,53.8s40.768,18.288,40.768,40.767S150.408,135.333,127.928,135.333z"/>
                    <path style="fill:#bd2830" d="M127.928,0C75.784,0,33.362,42.422,33.362,94.566c0,30.072,25.22,74.875,40.253,98.904
                        c9.891,15.809,20.52,30.855,29.928,42.365c15.101,18.474,20.506,20.02,24.386,20.02c3.938,0,9.041-1.547,24.095-20.031
                        c9.429-11.579,20.063-26.616,29.944-42.342c15.136-24.088,40.527-68.971,40.527-98.917C222.495,42.422,180.073,0,127.928,0z
                         M171.569,181.803c-19.396,31.483-37.203,52.757-43.73,58.188c-6.561-5.264-24.079-26.032-43.746-58.089
                        c-22.707-37.015-35.73-68.848-35.73-87.336C48.362,50.693,84.055,15,127.928,15c43.873,0,79.566,35.693,79.566,79.566
                        C207.495,112.948,194.4,144.744,171.569,181.803z"/>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                </svg>
            <img class="placemarks" id="pm1" src="{{asset('/img/icons/placemark.svg')}}">
            <img class="placemarks" id="pm2" src="{{asset('/img/icons/placemark.svg')}}">
            <img class="placemarks" id="pm3" src="{{asset('/img/icons/placemark.svg')}}">



            <a href="#s1" class="same-page-nav" id="arrow_down"><img src="{{asset('/img/icons/arrow_down.svg')}}"></a>
        </header>
        <section id="s1">
            <h1>Explora tu ciudad</h1>
            <a href="#contacto" class="same-page-nav" id="contacto-link">CONTACTO</a>
        </section>
        <section id="s2">
            <div>
                <h2>Crea tu propia experiencia</h2>
                <img src="{{asset('/img/qa.svg')}}">
            </div>
            <div>
                <h2>o vive una ya diseñada</h2>
                <img src="{{asset('/img/explorer.svg')}}">
            </div>
        </section>
        <section id="contacto">
            <h2>¡Contacta con nosotros!</h2>
            <form action="{{route('contact-message')}}" method="post" id="contacto-form">
                @csrf
                <div id="inputs">
                    <input type="text" name="nombre" placeholder="Nombre">
                    <span class="error" data-for="nombre"></span>
                    <input type="email" name="email" placeholder="Correo electrónico">
                    <span class="error" data-for="email"></span>
                    <textarea name="mensaje" placeholder="Mensaje"></textarea>
                    <span class="error" data-for="mensaje"></span>
                </div>
                <button type="button" id="send"><img src="{{asset('/img/icons/send.svg')}}"></button>
            </form>
        </section>
        <footer>
            Koldo Intxausti &copy, 2019
            <div>
                <img src="{{asset('/img/icons/instagram.svg')}}">
                <img src="{{asset('/img/icons/twitter.svg')}}">
                <img src="{{asset('/img/icons/facebook.svg')}}">
            </div>
        </footer>
    </body>
</html>
