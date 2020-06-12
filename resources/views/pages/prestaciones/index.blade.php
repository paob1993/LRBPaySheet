<link rel="icon" type="image/png" href="{{url('assets/img/favicon.ico')}}">
@extends('layouts.dashboard.default')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class='col-md-12 no-padding ghost'>
            @if(session('alert'))
            <div class="col-xs-12">
                <div class="callout callout-{{session('alert')["tipo"]}}" role="alert">
                    <span>
                        <b>{{session('alert')["titulo"]}} -</b> {{session('alert')["mensaje"]}}
                    </span>
                </div>
            </div>
            @endif
            @if(count($errors->all()) > 0)
            <div class="col-xs-12">
                @foreach($errors->all() as $error)
                <div class="callout callout-danger" role="alert">
                    <span>
                        <b>Error -</b> {{$error}}
                    </span>
                </div>
                @endforeach
            </div>
            @endif
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Prestaciones</h4>
                </div>
                
                <div class='content'>
                    <form class='form-horizontal' method='GET'>
                        
                        <div class='col-lg-3 col-md-6 col-xs-12 margin-top div-fix-height'>
                            <label for="$id_recibo_prestaciones">Recibo <a data-toggle="tooltip" title="Filtrar por recibo"><i class="fa fa-lg fa-info-circle" style="color:#56AEFF;cursor:pointer;" aria-hidden="true"></i></a></label>
                            <select class="form-control" name="id_recibo_prestaciones">
                                <option value="" selected>Selecciona</option>
                                @foreach($recibos_prestaciones as $recibo_prestaciones)
                                @if($id_recibo_prestaciones == $recibo_prestaciones->id)
                                <option value="{{$recibo_prestaciones->id}}" selected>{{$recibo_prestaciones->trimestre}} - {{$recibo_prestaciones->ano}}</option>
                                @else
                                <option value="{{$recibo_prestaciones->id}}">{{$recibo_prestaciones->trimestre}} - {{$recibo_prestaciones->ano}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        
                        <div class='col-lg-3 col-md-6 col-xs-12 margin-top div-fix-height'>
                            <label for="cantidad">Cantidad <a data-toggle="tooltip" title="Filtrar por cantidad"><i class="fa fa-lg fa-info-circle" style="color:#56AEFF;cursor:pointer;" aria-hidden="true"></i></a></label>
                            <select class="form-control" name="cantidad">
                                @foreach(\App\OwnModels\Utilidades::$cantidad_option as $key => $value)
                                @if($busqueda_cantidad == $key)
                                <option value="{{$key}}" selected>{{$value}}</option>
                                @else
                                <option value="{{$key}}">{{$value}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>

                        <div class='col-xs-12 margin-top text-center'>
                            <button class='btn btn-primary' type='submit'>Buscar <i class='fa fa-lg fa-search'></i></button>
                            <button class='btn btn-success'>Descargar <i class='fa fa-lg fa-download'></i></button>
                        </div>
                        
                    </form>

                    <div class="table-responsive table-full-width">
                        <table class="table table-hover table-striped table-center">
                            <thead>
                                <tr>
                                   <th>Empleado</th>
                                   <th>Cédula</th>
                                   <th>Cargo</th>
                                   <th>Prestaciones Sociales Trimestre</th>
                                   <th>Prestaciones Sociales Acumuladas</th>
                                   <th><i class="fa fa-lg- fa-cogs"></i></th>
                               </tr>
                            </thead>
                            <tbody>
                               @if(count($prestaciones_sociales) == 0)
                                <tr>
                                    <td colspan='12'>No se han encontrado resultados...</td>
                                </tr>
                                @else
                                @foreach($prestaciones_sociales as $prestacion_social)
                                <tr>
                                <td>{{$prestacion_social->empleado->nombres}} {{$prestacion_social->empleado->apellidos}}</td>
                                <td>{{$prestacion_social->empleado->cedula}}</td>
                                <td>{{$prestacion_social->empleado->cargo->descripcion}}</td>
                                <td>{{$prestacion_social->monto}}</td>
                                <td>{{$prestacion_social->empleado->prestaciones_sociales_acumuladas}}</td>
                                <td>
                                    <a class="color-edit" href="javascript:reciboPrestacionesShow('{{url('recibosPrestaciones/'.$prestacion_social->id)}}','{{url('exportar/reciboPrestacionesEmpleado/'.$prestacion_social->id)}}')" data-toggle="tooltip" title="Visualizar"><i class="far fa-eye" aria-hidden='true'></i></a>
                                </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                        <div class="text-center">{{$prestaciones_sociales->appends([
                            'busqueda_cantidad' => $busqueda_cantidad, 
                            'id_recibo_prestaciones' => $id_recibo_prestaciones,
                            ])->render()}}
                        </div>
                    </div>        

                </div>
            </div>
        </div>
    </div>
</div>

@stop

@include('pages.prestaciones.show');