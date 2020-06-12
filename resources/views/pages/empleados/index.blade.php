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
                    <h4 class="title">Empleados</h4> 
                    <p class="category">
                        <div class='col-xs-12'>
                            <p class='pull-right'>
                                <a class="btn btn-primary link-no-style" href="javascript:empleadoStore('{{url('empleados')}}')" title="Agregar">Agregar <i class="fa fa-lg fa-plus" aria-hidden='true'></i></a>
                            </p>
                        </div>
                    </p>                   
                </div>
                
                <div class='content'>
                    <form class='form-horizontal' method='GET'>

                        <div class='col-lg-3 col-md-6 col-xs-12 margin-top div-fix-height'>
                            <label for="nombres">Nombres <a data-toggle="tooltip" title="Buscar por nombres"><i class="fa fa-lg fa-info-circle" style="color:#56AEFF;cursor:pointer;" aria-hidden="true"></i></a></label>
                            <input type="text" class="form-control"id="nombres" name="nombres" value="{{$nombres}}" />
                        </div>
                        <div class='col-lg-3 col-md-6 col-xs-12 margin-top div-fix-height'>
                            <label for="apellidos">Apellidos <a data-toggle="tooltip" title="Buscar por apellidos"><i class="fa fa-lg fa-info-circle" style="color:#56AEFF;cursor:pointer;" aria-hidden="true"></i></a></label>
                            <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{$apellidos}}" />
                        </div>
                        <div class='col-lg-3 col-md-6 col-xs-12 margin-top div-fix-height'>
                            <label for="cedula">Cédula <a data-toggle="tooltip" title="Buscar por cédula"><i class="fa fa-lg fa-info-circle" style="color:#56AEFF;cursor:pointer;" aria-hidden="true"></i></a></label>
                            <input type="text" class="form-control" id="cedula" name="cedula" value="{{$cedula}}" />
                        </div>
                        <div class='col-lg-3 col-md-6 col-xs-12 margin-top div-fix-height'>
                            <label for="cargo">Cargo <a data-toggle="tooltip" title="Buscar por cargo"><i class="fa fa-lg fa-info-circle" style="color:#56AEFF;cursor:pointer;" aria-hidden="true"></i></a></label>
                            <select class="form-control" name="cargo_filtro">
                                <option value="" selected>Seleccione</option>
                                @foreach($cargos as $cargo)
                                @if($cargo == $cargo_filtro)
                                <option value="{{$cargo->id}}">{{$cargo->descripcion}}</option>
                                @else
                                <option value="{{$cargo->id}}">{{$cargo->descripcion}}</option>
                                @endif
                                @endforeach
                            </select>                        
                        </div>
                        <div class='col-lg-3 col-md-6 col-xs-12 margin-top div-fix-height'>
                            <label for="tipo_empleado">Tipo de Empleado <a data-toggle="tooltip" title="Filtrar por tipo de empleado"><i class="fa fa-lg fa-info-circle" style="color:#56AEFF;cursor:pointer;" aria-hidden="true"></i></a></label>
                            <select class="form-control" name="tipo_empleado">
                                <option value="">Selecciona</option>
                                @foreach(\App\OwnModels\OwnArrays::$tipos_empleados as $key => $value)
                                @if($tipo_empleado == $key)
                                <option value="{{$key}}" selected>{{$value}}</option>
                                @else
                                <option value="{{$key}}">{{$value}}</option>
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
                        </div>
                        
                    </form>

                    <div class="table-responsive table-full-width">
                        <table class="table table-hover table-striped table-center">
                            <thead>
                                <tr>
                                   <th>Usuario</th>
                                   <th>Nombres y Apellidos</th>
                                   <th>Cédula</th>
                                   <th>Cargo</th>
                                   <th>Categoría</th>
                                   <th>Tipo de Empleado</th>
                                   <th>Horas Semanales</th>
                                   <th>Fecha de Ingreso</th>
                                   <th>Antiguedad</th>
                                   <th><i class="fa fa-lg- fa-cogs"></i></th>
                               </tr>
                           </thead>
                           <tbody>
                            @if(count($empleados) == 0)
                            <tr>
                                <td colspan='12'>No se han encontrado resultados...</td>
                            </tr>
                            @else
                            @foreach($empleados as $empleado)
                            <tr>     
                                @if($empleado->user)   
                                <td>{{$empleado->user->cedula}}</td>           
                                @else         
                                <td>Sin Usuario</td>  
                                @endif
                                <td>{{$empleado->nombres}} {{$empleado->apellidos}}</td>
                                <td>{{$empleado->cedula}}</td>
                                <td>{{$empleado->cargo->descripcion}}</td>
                                <td>{{$empleado->obtenerCategoria()}}</td>
                                <td>{{App\OwnModels\OwnArrays::$tipos_empleados[$empleado->cargo->tipo_empleado]}}</td>
                                <td>{{$empleado->horas_semanales}}</td>
                                <td>{{$empleado->fecha_ingreso->format('d/m/Y')}}</td>
                                <td>{{$empleado->calcularAntiguedad()}}</td>
                                <td>
                                    <a class="color-edit" href="javascript:empleadoUpdate('{{url('empleados/'.$empleado->id)}}')" data-toggle="tooltip" title="Editar"><i class="fas fa-pencil-alt" aria-hidden='true'></i></a>
                                    <a class="color-remove" href="javascript:empleadoDelete('{{url('empleados/'.$empleado->id)}}','{{$empleado->nombres}}','{{$empleado->apellidos}}','{{$empleado->cedula}}')" data-toggle="tooltip" title="Eliminar"><i class="far fa-trash-alt" aria-hidden='true'></i></a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="text-center">{{$empleados->appends([
                            'cantidad' => $busqueda_cantidad, 
                            'nombres' => $nombres, 
                            'apellidos' => $apellidos,
                            'cedula' => $cedula,
                            'cargo_filtro' => $cargo_filtro,
                            'tipo_empleado' => $tipo_empleado
                        ])->render()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@include('pages.empleados.store')
@include('pages.empleados.update')
@include('pages.empleados.delete')