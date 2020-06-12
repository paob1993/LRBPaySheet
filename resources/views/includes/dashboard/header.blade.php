<link rel="icon" type="image/png" href="{{url('assets/img/favicon.ico')}}">
<div class="container-fluid" style="padding-left:0;padding-right:0;">
    <nav class="navbar navbar-default navbar-fixed" style="background: rgb(70, 120, 201);color: white;">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="{{url('home')}}" style="color: white;">
                            @if(Auth::user()->isAdministradorDelSistema())
                                Panel de Administrador del Sistema
                            @endif
                            @if(Auth::user()->isDirectivo())
                                Panel de Directivo
                            @endif
                            @if(Auth::user()->isEstructuraDeCostos())
                                Panel de Estructura de Costos
                            @endif
                            @if(Auth::user()->isNomina())
                                Panel de Nómina
                            @endif
                            @if(Auth::user()->isEmpleado())
                                Panel de Empleado
                            @endif
                        </a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <!--li>
                        <a title="Leads Nuevos" href="{{url('leads/pendientes')}}" style="color: #fff;">
                            <i class="fa fa-bell" aria-hidden="true" style="padding-right: 20px"> </i>
                            <span class="notification" id="leads_pendientes">
                            </span>
                        </a>
                    </li-->
<!--                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: white;">
                            Dropdown
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu" style="color: white;">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                    </li>-->
                    <li>
                        <a href="{{url('logout')}}" style="color: white;">
                            Salir
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>