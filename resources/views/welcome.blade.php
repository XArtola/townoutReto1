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
        <header>
            <!-- LOGO IMAGE SVG PATH -->
            <div id="logo">
                <svg width="322" height="82" xmlns="http://www.w3.org/2000/svg">
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
            <img class="placemarks" id="pm1" src="{{asset('/img/icons/placemark.svg')}}">
            <img class="placemarks" id="pm2" src="{{asset('/img/icons/placemark.svg')}}">
            <img class="placemarks" id="pm3" src="{{asset('/img/icons/placemark.svg')}}">

            <a href="#s1" class="same-page-nav" id="arrow_down"><img src="{{asset('/img/icons/arrow_down.svg')}}"></a>
        </header>
        <section id="s1">
            <h1>Explora tu ciudad</h1>
            <a href="#contacto" class="same-page-nav" id="contacto-link">CONTACTO</a>
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
    </body>
</html>
