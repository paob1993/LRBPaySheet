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
   <div class="card col-md-12">
      <div class="header">
         <h4 class="title">Prestaciones sociales</h4>
      </div>
      <br>
      <div class='content'>
         <div class="col-md-12">
            <div class="card" style="box-shadow: 0 1px 2px rgba(0, 0, 0, 0.00), 0 0 0 1px rgba(63, 63, 68, 0);">
               <div class="card-header">
                  <h5 class="title"><span style="font-weight: 600;"> 2do. Paso:</span> Verificar Configuraciones:</h5>
                  <br>
               </div>
               <div class="card-body ">
                  <!-- Paso 2 -->
                  <div class="table-responsive table-full-width">
                     <table class="table table-hover table-striped table-center">
                        <thead>
                           <tr>
                              <th>Descripción</th>
                              <th>Valor para Administrativo</th>
                              <th>Valor para Obrero</th>
                              <th>Valor para Docente</th>
                              <th>Tipo de Valor</th>
                              <th>Fórmula</th>
                              <th><i class="fa fa-lg- fa-cogs"></i></th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($prestaciones_configuraciones as $variableGlobal)
                           <tr>
                              <td>{{$variableGlobal->descripcion}}</td>
                              <td>{{$variableGlobal->obtenerParaTipoEmpleado(1)}}</td>
                              <td>{{$variableGlobal->obtenerParaTipoEmpleado(2)}}</td>
                              <td>{{$variableGlobal->obtenerParaTipoEmpleado(3)}}</td>
                              <td>{{App\OwnModels\OwnArrays::$tipos_valor[$variableGlobal->tipo_valor]}}</td>
                              <td>{{App\OwnModels\OwnArrays::$formulas[$variableGlobal->formula]}}</td>
                              <td>
                                 <a class="color-edit" href="javascript:variablesGlobalesUpdate('{{url('variablesGlobales/'.$variableGlobal->id)}}')" title="Editar" data-toggle="tooltip"><i class="fas fa-pencil-alt" aria-hidden='true'></i></a>
                              </td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                  </div>
                  <div class="col-xs-12 text-center margin-top modal-footer">
                     <a href="javascript:confirmationModal('{{url('prestaciones')}}','{{$recibo_prestaciones_id}}')">
                     <button type="button" class="btn btn-primary" id="btn-action-cestaticket">Siguiente</button>
                     </a>
                     <a  href="{{url('recibosPrestaciones/crear')}}">
                     <button  type="button" class="btn btn-default">Cancelar</button>
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@include('pages.variablesGlobales.update')
@include('includes.confirmation')