<div class="sidebar-wrapper">
   <div class="logo">
      <a href="{{url('')}}" class="simple-text">
      <img src='{{url("assets/img/logo.png")}}' alt='UEC "NSDLC"' title='UEC "NSDLC"'/>
      </a>
   </div>
   <ul class="nav">
      <li class="{{ Request::is('home') ? 'active' : '' }}">
         <a href="{{url('home')}}">
            <i class="fa fa-home fa-lg"></i>
            <p>Inicio</p>
         </a>
      </li>
      @can('index', 'App\User')
      <li class="{{ Request::is('usuarios') ? 'active' : '' }}">
         <a href="{{url('usuarios')}}">
            <i class="fa fa-users fa-lg"></i>
            <p>Usuarios</p>
         </a>
      </li>
      @endcan
      @can('index', 'App\Models\RegistroNomina')
      <li class="{{ Request::is('registroNominas') ? 'active' : '' }}">
         <a href="{{url('registroNominas')}}">
            <i class="fas fa-barcode fa-lg"></i>
            <p>Registros Nóminas</p>
         </a>
      </li>
      @endcan
      @can('index', 'App\Models\Cargo')
      <li class="{{ Request::is('cargos') ? 'active' : '' }}">
         <a href="{{url('cargos')}}">
            <i class="fa fa-sitemap fa-lg"></i>
            <p>Cargos</p>
         </a>
      </li>
      @endcan
      @can('index', 'App\Models\CategoriaDocente')
      <li class="{{ Request::is('categoriasDocentes') ? 'active' : '' }}">
         <a href="{{url('categoriasDocentes')}}">
            <i class="fas fa-chalkboard-teacher fa-lg"></i>
            <p>Categorías Docentes</p>
         </a>
      </li>
      @endcan
      @can('index', 'App\Models\ClasificacionObrero')
      <li class="{{ Request::is('clasificacionObreros') ? 'active' : '' }}">
         <a href="{{url('clasificacionObreros')}}">
            <i class="fas fa-user-cog fa-lg"></i>
            <p>Clasificación Obreros</p>
         </a>
      </li>
      @endcan
      @can('index', 'App\Models\ClasificacionAdministrativo')
      <li class="{{ Request::is('clasificacionAdministrativos') ? 'active' : '' }}">
         <a href="{{url('clasificacionAdministrativos')}}">
            <i class="fas fa-user-graduate fa-lg"></i>
            <p>Clasificación Administrativos</p>
         </a>
      </li>
      @endcan
      @can('index', 'App\Models\Empleado')
      <li class="{{ Request::is('empleados') ? 'active' : '' }}">
         <a href="{{url('empleados')}}">
            <i class="fa fa-users fa-lg"></i>
            <p>Empleados</p>
         </a>
      </li>
      @endcan
      @can('index', 'App\Models\ReciboPrestacionesSociales')
      <li class="{{ Request::is('prestaciones') ? 'active' : '' }}">
         <a href="{{url('prestaciones')}}">
            <i class="fa fa-plus-square fa-lg"></i>
            <p>Prestaciones Sociales</p>
         </a>
      </li>
      @endcan
       @can('index', 'App\Models\Recibo')
      <li class="{{ Request::is('recibosNomina') ? 'active' : '' }}">
         <a href="{{url('recibosNomina')}}">
            <i class="fas fa-money-check fa-lg"></i>
            <p>Recibos Nómina</p>
         </a>
      </li>
      @endcan
      @can('index', 'App\Models\Recibo')
      <li class="{{ Request::is('recibos') ? 'active' : '' }}">
         <a href="{{url('recibos')}}">
            <i class="fa fa-shopping-basket fa-lg"></i>
            <p>Cestatickets</p>
         </a>
      </li>
      @endcan
      @can('index', 'App\Models\VariablesGlobales')
      <li class="{{ Request::is('variablesGlobales') ? 'active' : '' }}">
         <a href="{{url('variablesGlobales')}}">
            <i class="fas fa-pen-fancy fa-lg"></i>
            <p>Variables Globales</p>
         </a>
      </li>
      @endcan
      @can('index', 'App\Models\Recordatorios')
      <li class="{{ Request::is('recordatorios') ? 'active' : '' }}">
         <a href="{{url('recordatorios')}}">
            <i class="fas fa-thumbtack fa-lg"></i>
            <p>Recordatorios</p>
         </a>
      </li>
      @endcan
   </ul>
</div>