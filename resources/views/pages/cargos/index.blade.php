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
            <h4 class="title">Cargos</h4>
            <p class="category">
            <div class='col-xs-12'>
               <p class='pull-right'>
                  <a class="btn btn-primary link-no-style" href="javascript:cargoStore('{{url('cargos')}}')" title="Agregar">Agregar <i class="fa fa-lg fa-plus" aria-hidden='true'></i></a>
               </p>
            </div>
            </p>
         </div>
         <div class='content'>
            <form class='form-horizontal' method='GET'>
               <div class='col-lg-3 col-md-6 col-xs-12 margin-top div-fix-height'>
                  <label for="abreviatura">Abreviatura <a data-toggle="tooltip" title="Buscar por código nómina"><i class="fa fa-lg fa-info-circle" style="color:#56AEFF;cursor:pointer;" aria-hidden="true"></i></a></label>
                  <input type="text" class="form-control" name="abreviatura" value="{{$abreviatura}}" />
               </div>
               <div class='col-lg-3 col-md-6 col-xs-12 margin-top div-fix-height'>
                  <label for="descripcion">Descripción <a data-toggle="tooltip" title="Buscar por descripción"><i class="fa fa-lg fa-info-circle" style="color:#56AEFF;cursor:pointer;" aria-hidden="true"></i></a></label>
                  <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{$descripcion}}" />
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
                  <select class="form-control dropdown" name="cantidad">
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
                        <th>Abreviatura</th>
                        <th>Descripción</th>
                        <th>Tipo de Empleado</th>
                        <th><i class="fa fa-lg- fa-cogs"></i></th>
                     </tr>
                  </thead>
                  <tbody>
                     @if(count($cargos) == 0)
                     <tr>
                        <td colspan='12'>No se han encontrado resultados...</td>
                     </tr>
                     @else
                     @foreach($cargos as $cargo)
                     <tr>
                        <td>{{$cargo->abreviatura}}</td>
                        <td>{{$cargo->descripcion}}</td>
                        <td>{{\App\OwnModels\OwnArrays::$tipos_empleados[$cargo->tipo_empleado]}}</td>
                        <td>
                           <a class="color-edit" href="javascript:cargoUpdate('{{url('cargos/'.$cargo->id)}}')" title="Editar" data-toggle="tooltip"><i class="fas fa-pencil-alt" aria-hidden='true'></i></a>
                        </td>
                     </tr>
                     @endforeach
                     @endif
                  </tbody>
               </table>
               <div class="text-center">{{$cargos->appends([
                  'cantidad' => $busqueda_cantidad, 
                  'abreviatura' => $abreviatura,
                  'descripcion' => $descripcion,
                  'tipo_empleado' => $tipo_empleado,
                  ])->render()}}
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
@stop
@include('pages.cargos.store')
@include('pages.cargos.update')