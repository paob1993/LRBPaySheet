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
            <h4 class="title text-center" style="font-weight: 600;">Gestión de Nómina:</h4><p class="category">            
         <div class='content'>
            <div class="col-md-12">
               <div class="card" style="box-shadow: 0 1px 2px rgba(0, 0, 0, 0.00), 0 0 0 1px rgba(63, 63, 68, 0);">
                  <div class="card-header">
                     <h5 class="title"><span style="font-weight: 600;"> 3er. Paso:</span> Verificar la Asignaciones y Deducciones Manuales a aplicar</h5>
                     <br>
                  </div>
                  <div class="card-body ">
                     <!-- Paso 2 -->
                     <form class='form-horizontal' method='POST' action="gestionNomina/manual">
                        {!! csrf_field() !!}
                        <input type="hidden" name="recibo_id" value="{{$recibo_id}}">           
                           
                        <div class="table-responsive table-full-width">
                           <table class="table table-hover table-striped table-center">
                              <thead>
                                 <tr>
                                    <th>A Incluir</th>
                                    <th>Nombre</th>
                                    <th>Tipo Valor</th>
                                    <th>Código Nómina</th>
                                    <th>Tipo Nómina</th>
                                    <th>Basado en </th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @foreach($registros_nomina as $registro)
                                 <tr>
                                    <td><input type="checkbox" name="{{$registro->id}}" checked="true"></td>
                                    <td>{{$registro->nombre}}</td>
                                    <td>{{\App\OwnModels\OwnArrays::$tipos_valor[$registro->tipo_valor]}}</td>
                                    <td>{{$registro->codigo_nomina}}</td>
                                    <td>{{\App\OwnModels\OwnArrays::$tipos_nominas[$registro->tipo_nomina]}}</td>
                                    <td>{{\App\OwnModels\OwnArrays::$basados_en[$registro->basado_en]}}</td>
                                 </tr>
                                 @endforeach
                              </tbody>
                           </table>
                        </div>
                     </div>
                        <div class="col-xs-12 text-center margin-top modal-footer">
                           <button type="submit" class="btn btn-primary" id="btn-action-gestion-nomina">Siguiente</button>
                           <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
</div>
@endsection
@include('pages.registroNomina.store')
@include('pages.registroNomina.update')