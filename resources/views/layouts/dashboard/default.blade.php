<!doctype html>
<html>
   <head lang="es">
      @include('includes.dashboard.head')
   </head>
   <body>
      <div>
         <div class="wrapper">
            <div class="sidebar" data-color="blue" data-image="{{url('assets/img/sidebar-5.jpg')}}">
               @include('includes.dashboard.sidebar')
            </div>
            <div class="main-panel">
               <nav class="navbar navbar-default navbar-fixed">
                  @include('includes.dashboard.header')
               </nav>
               <div class="content">
                  @yield('content')
               </div>
            </div>
         </div>
      </div>
   </body>
</html>