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
            <h4 class="title text-center" style="font-weight: 600;">Gestión de Nómina:</h4>
         </div>
         <div class='content'>
            <div class="col-md-12">
               <div class="card" style="box-shadow: 0 1px 2px rgba(0, 0, 0, 0.00), 0 0 0 1px rgba(63, 63, 68, 0);">
                  <div class="card-header">
                     <h5 class="title"><span style="font-weight: 600;"> 3er. Paso:</span> Editar los empleados para asignar o descontar codigos manuales </h5>
                     <br>
                  </div>
                  <div class="card-body ">
                     <form class='form-horizontal' method='GET'>
                        <div class='col-lg-3 col-md-6 col-xs-12 margin-top div-fix-height'>
                           <label for="nombres">Nombres <a data-toggle="tooltip" title="Buscar por nombres"><i class="fa fa-lg fa-info-circle" style="color:#56AEFF;cursor:pointer;" aria-hidden="true"></i></a></label>
                           <input type="text" class="form-control" id="busqueda_nombres" name="nombres" value="{{$nombres}}" />
                        </div>
                        <div class='col-lg-3 col-md-6 col-xs-12 margin-top div-fix-height'>
                           <label for="apellidos">Apellidos <a data-toggle="tooltip" title="Buscar por apellidos"><i class="fa fa-lg fa-info-circle" style="color:#56AEFF;cursor:pointer;" aria-hidden="true"></i></a></label>
                           <input type="text" class="form-control" id="busqueda_apellidos" name="apellidos" value="{{$apellidos}}" />
                        </div>
                        <div class='col-lg-3 col-md-6 col-xs-12 margin-top div-fix-height'>
                           <label for="cedula">Cédula de Identidad <a data-toggle="tooltip" title="Buscar por cédula de identidad"><i class="fa fa-lg fa-info-circle" style="color:#56AEFF;cursor:pointer;" aria-hidden="true"></i></a></label>
                           <input type="text" class="form-control" id="busqueda_cedula" name="cedula" value="{{$cedula}}" />
                        </div>
                        <div class='col-xs-12 margin-top text-center'>
                           <button class='btn btn-primary' type='submit'>Buscar <i class='fa fa-lg fa-search'></i></button>
                        </div>
                     </form>
                        <div class="table-responsive table-full-width">
                           <table class="table table-hover table-striped table-center"> 
                              <thead>
                                 <tr>
                                    <th>Nombres y Apellidos</th>
                                    <th>Cédula</th>
                                    <th>Cargo</th>
                                    <th><i class="fa fa-lg fa-cogs"></i></th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @foreach($empleados as $empleado)
                                 <tr>
                                    <td>{{$empleado->nombres}} {{$empleado->apellidos}}</td>
                                    <td>{{$empleado->cedula}}</td>
                                    <td>{{$empleado->cargo->descripcion}}</td>
                                    <td>
                                       <a class="color-edit" href="javascript:registroNominaStore('{{url('gestionNomina/registro')}}','{{url('gestionNomina/'.$recibo_id.'/'.$empleado->id)}}','{{$empleado->id}}','{{$empleado->nombres}} {{$empleado->apellidos}}','{{$recibo_id}}')" title="Editar" data-toggle="tooltip"><i class="fas fa-pencil-alt" aria-hidden='true'></i></a>
                                    </td>
                                 </tr>
                                 @endforeach
                              </tbody>
                           </table>
                        </div>
                     </div>
                        <div class="col-xs-12 text-center margin-top modal-footer">
                           <a href="javascript:confirmationModal('{{url('gestionNomina/primeraQuincena')}}','{{$recibo_id}}')">
                              <button type="button" class="btn btn-primary" id="btn-action-gestion-nomina">Siguiente</button>
                           </a>
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
@include('pages.gestionNomina.storeRegistroManual')
@include('includes.confirmation')