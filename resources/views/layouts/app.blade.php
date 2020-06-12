<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="icon" type="image/png" href="{{url('assets/img/favicon.ico')}}">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>{{ config('app.name', 'U.E.C. "Nuestra Señora de la Consolación') }}</title>
      <!-- Styles -->
      <link href="{{url('css/app.css')}}" rel="stylesheet">
      <!-- Scripts -->
      <script>
         window.Laravel = {!! json_encode([
             'csrfToken' => csrf_token(),
         ]) !!};
      </script>
      <script src="{{url('assets/js/jquery-1.10.2.js')}}" type="text/javascript"></script>
      <style>
         .centrado-porcentual {
         position: absolute;
         left: 50%;
         top: 40%;
         transform: translate(-50%, -50%);
         -webkit-transform: translate(-50%, -50%);
         }
         html {
         background: url(assets/img/fondo.jpg) no-repeat center center fixed;
         -webkit-background-size: cover;
         -moz-background-size: cover;
         -o-background-size: cover;
         background-size: cover;
         }
      </style>
   </head>
   <body >
      <div id="app">
         @yield('content')
      </div>
      <!-- Scripts -->
      <script src="{{url('js/app.js')}}"></script>
      <script src="{{url('assets/js/funciones.js')}}" type="text/javascript"></script>
   </body>
</html>