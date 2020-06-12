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
            <h4 class="title">Registros Nómina</h4>
            <p class="category">
            <div class='col-xs-12'>
               <p class='pull-right'>
                  <a class="btn btn-primary link-no-style" href="javascript:registroNominaStore('{{url('registroNominas')}}','0')" title="Agregar">Agregar <i class="fa fa-lg fa-plus" aria-hidden='true'></i></a>
               </p>
            </div>
            </p>
         </div>
         <div class='content'>
            <form class='form-horizontal' method='GET'>
               <div class='col-lg-3 col-md-6 col-xs-12 margin-top div-fix-height'>
                  <label for="nombre">Nombre <a data-toggle="tooltip" title="Buscar por nombre"><i class="fa fa-lg fa-info-circle" style="color:#56AEFF;cursor:pointer;" aria-hidden="true"></i></a></label>
                  <input type="text" class="form-control" name="nombre" value="{{$nombre}}" />
               </div>

               <div class='col-lg-3 col-md-6 col-xs-12 margin-top div-fix-height'>
                  <label for="tipo_valor">Tipo Valor <a data-toggle="tooltip" title="Buscar por tipo valor"><i class="fa fa-lg fa-info-circle" style="color:#56AEFF;cursor:pointer;" aria-hidden="true"></i></a></label>
                  <select class="form-control dropdown" name="tipo_valor">
                     <option value="">Selecciona</option>
                     @foreach(\App\OwnModels\OwnArrays::$tipos_valor as $key => $value)
                     @if($tipo_valor == $key)
                     <option value="{{$key}}" selected>{{$value}}</option>
                     @else
                     <option value="{{$key}}">{{$value}}</option>
                     @endif
                     @endforeach
                  </select>
               </div>

               <div class='col-lg-3 col-md-6 col-xs-12 margin-top div-fix-height'>
                  <label for="codigo_nomina">Código Nómina <a data-toggle="tooltip" title="Buscar por código nómina"><i class="fa fa-lg fa-info-circle" style="color:#56AEFF;cursor:pointer;" aria-hidden="true"></i></a></label>
                  <input type="text" class="form-control" id="codigo_nomina" name="codigo_nomina" value="{{$codigo_nomina}}" />
               </div>

               <div class='col-lg-3 col-md-6 col-xs-12 margin-top div-fix-height'>
                  <label for="tipo_nomina">Tipo Nómina <a data-toggle="tooltip" title="Buscar por tipo nómina"><i class="fa fa-lg fa-info-circle" style="color:#56AEFF;cursor:pointer;" aria-hidden="true"></i></a></label>
                  <select class="form-control dropdown" name="tipo_nomina">
                     <option value="">Selecciona</option>
                     @foreach(\App\OwnModels\OwnArrays::$tipos_nominas as $key => $value)
                     @if($tipo_nomina == $key)
                     <option value="{{$key}}" selected>{{$value}}</option>
                     @else
                     <option value="{{$key}}">{{$value}}</option>
                     @endif
                     @endforeach
                  </select>               
               </div>

               <div class='col-lg-3 col-md-6 col-xs-12 margin-top div-fix-height'>
                  <label for="basado_en">Basado en <a data-toggle="tooltip" title="Buscar basado en"><i class="fa fa-lg fa-info-circle" style="color:#56AEFF;cursor:pointer;" aria-hidden="true"></i></a></label>
                  <select class="form-control dropdown" name="basado_en">
                  <option value="">Selecciona</option>
                     @foreach(\App\OwnModels\OwnArrays::$basados_en as $key => $value)
                     @if($basado_en == $key)
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
                     <option value="">Selecciona</option>                    
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
                        <th>Nombre</th>
                        <th>Cantidad Administrativo</th>
                        <th>Cantidad Obrero</th>
                        <th>Cantidad Docente</th>
                        <th>Tipo Valor</th>
                        <th>Código Nómina</th>
                        <th>Tipo Nómina</th>
                        <th>Basado en </th>
                        <th><i class="fa fa-lg- fa-cogs"></i></th>
                     </tr>
                  </thead>
                  <tbody>
                     @if(count($registrosNomina) == 0)
                     <tr>
                        <td colspan='12'>No se han encontrado resultados...</td>
                     </tr>
                     @else
                     @foreach($registrosNomina as $registroNomina)
                     <tr>
                        <td>{{$registroNomina->nombre}}</td>
                        <td>{{$registroNomina->obtenerParaTipoEmpleado(1)}}</td>
                        <td>{{$registroNomina->obtenerParaTipoEmpleado(2)}}</td>
                        <td>{{$registroNomina->obtenerParaTipoEmpleado(3)}}</td>
                        <td>{{\App\OwnModels\OwnArrays::$tipos_valor[$registroNomina->tipo_valor]}}</td>
                        <td>{{$registroNomina->codigo_nomina}}</td>
                        <td>{{\App\OwnModels\OwnArrays::$tipos_nominas[$registroNomina->tipo_nomina]}}</td>
                        <td>{{\App\OwnModels\OwnArrays::$basados_en[$registroNomina->basado_en]}}</td>
                        <td>
                           <a class="color-edit" href="javascript:registroNominaUpdate('{{url('registroNominas/'.$registroNomina->id)}}', '0')" title="Editar" data-toggle="tooltip"><i class="fas fa-pencil-alt" aria-hidden='true'></i></a>
                        </td>
                     </tr>
                     @endforeach
                     @endif
                  </tbody>
               </table>
               <div class="text-center">{{$registrosNomina->appends([
                  'cantidad' => $busqueda_cantidad, 
                  'nombre' => $nombre,
                  'tipo_valor' => $tipo_valor,
                  'codigo_nomina' => $codigo_nomina,
                  'tipo_nomina => $tipo_nomina',
                  'basado_en' => $basado_en
                  ])->render()}}
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@stop
@include('pages.registroNomina.store')
@include('pages.registroNomina.update')