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
                    <h4 class="title">Usuarios</h4>                    
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
                            <label for="cedula">Cedula <a data-toggle="tooltip" title="Buscar por cedula"><i class="fa fa-lg fa-info-circle" style="color:#56AEFF;cursor:pointer;" aria-hidden="true"></i></a></label>
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
                                   <th>Cedula</th>                                   
                                   <th>Cargo</th>
                                   <th><i class="fa fa-lg- fa-cogs"></i></th>
                               </tr>
                           </thead>
                           <tbody>
                            @if(count($users) == 0)
                            <tr>
                                <td colspan='12'>No se han encontrado resultados...</td>
                            </tr>
                            @else
                            @foreach($users as $empleado)
                            <tr>     
                                @if($empleado->user)   
                                <td>{{$empleado->user->cedula}}</td>           
                                @else         
                                <td>Sin Usuario</td>  
                                @endif
                                <td>{{$empleado->nombres}} {{$empleado->apellidos}}</td>
                                <td>{{$empleado->cedula}}</td>
                                <td>{{$empleado->cargo->descripcion}}</td>
                                <td>
                                    @if($empleado->user)
                                    <a class="color-edit" href="javascript:usuarioUpdate('{{url('usuarios/'.$empleado->user->id)}}')" title="Editar"><i class="fas fa-user-edit" aria-hidden='true'></i></a>
                                    <a class="color-remove" href="javascript:usuarioDelete('{{url('usuarios/'.$empleado->user->id)}}','{{$empleado->cedula}}')" title="Eliminar"><i class="fas fa-user-minus" aria-hidden='true'></i></a>
                                    @else
                                    @if(Auth::user()->isAdministradorDelSistema())
                                    <a class="color-edit" href="javascript:usuarioStore('{{url('usuarios')}}','{{$empleado->id}}','{{$empleado->cedula}}', '{{$empleado->cargo->descripcion}}')" data-toggle="tooltip" title="Crear"><i class="faS fa-user-plus" aria-hidden='true'></i></a>
                                    @endif
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="text-center">{{$users->appends([
                            'cantidad' => $busqueda_cantidad, 
                            'nombres' => $nombres, 
                            'apellidos' => $apellidos,
                            'cedula' => $cedula,
                            'cargo_filtro' => $cargo_filtro
                        ])->render()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@include('pages.users.store')
@include('pages.users.update')
@include('pages.users.delete')