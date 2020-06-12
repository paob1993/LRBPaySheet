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
                    <h4 class="title">Recordatorios</h4> 
                    <p class="category">
                        <div class='col-xs-12'>
                            <p class='pull-right'>
                                <a class="btn btn-primary link-no-style" href="javascript:recordatorioStore('{{url('recordatorios')}}')" title="Agregar">Agregar <i class="fa fa-lg fa-plus" aria-hidden='true'></i></a>
                            </p>
                        </div>
                    </p> 
                </div>
                
                <div class='content'>
                    <form class='form-horizontal' method='GET'>

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
                                   @if(Auth::user()->isAdministradorDelSistema()) 
                                   <th>Empleado</th>
                                   @endif
                                   <th>Nota</th>
                                   <th>Fecha</th>
                                   <th><i class="fa fa-lg- fa-cogs"></i></th>
                               </tr>
                           </thead>
                           <tbody>
                            @if(count($recordatorios) == 0)
                            <tr>
                                <td colspan='12'>No se han encontrado resultados...</td>
                            </tr>
                            @else
                            @foreach($recordatorios as $recordatorio)
                            <tr>  
                                @if(Auth::user()->isAdministradorDelSistema())   
                                <td>{{$recordatorio->empleado->nombres}} {{$recordatorio->empleado->apellidos}}</td>
                                @endif
                                <td>{{$recordatorio->nota}}</td>
                                <td>{{$recordatorio->fecha->format('d/m/Y')}}</td>
                                <td>
                                    <a class="color-edit" href="javascript:recordatorioUpdate('{{url('recordatorios/'.$recordatorio->id)}}')" title="Editar"><i class="fas fa-pencil-alt" aria-hidden='true'></i></a>
                                    <a class="color-edit" href="javascript:recordatorioDelete('{{url('recordatorios/'.$recordatorio->id)}}','{{$recordatorio->empleado->nombres}}','{{$recordatorio->empleado->apellidos}}','{{$recordatorio->nota}}')" title="Editar"><i class="far fa-trash-alt" aria-hidden='true'></i></a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="text-center">{{$recordatorios->appends([
                            'cantidad' => $busqueda_cantidad, 
                        ])->render()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@include('pages.recordatorios.store')
@include('pages.recordatorios.update')
@include('pages.recordatorios.delete')