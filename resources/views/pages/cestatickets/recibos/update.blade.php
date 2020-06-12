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
   <div class="row">
      <div class="card col-md-12">
         <div class="header">
            <h4 class="title">Cestatickets</h4>
         </div>
         <br>
         <div class='content'>
            <div class="col-md-12">
               <div class="card" style="box-shadow: 0 1px 2px rgba(0, 0, 0, 0.00), 0 0 0 1px rgba(63, 63, 68, 0);">
                  <div class="card-header">
                     <h5 class="title"><span style="font-weight: 600;"> 3er. Paso:</span> Ingresar Faltas del  <span style="font-weight: 600;">Periodo:</span> {{$periodo->mes}}-{{$periodo->ano}}</h5>
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
                     <!-- Paso 3 -->
                     <div class="table-responsive table-full-width">
                        <table class="table table-hover table-striped table-center">
                           <thead>
                              <tr>
                                 <th>Empleado</th>
                                 <th>Cedula</th>
                                 <th>Cargo</th>
                                 <th>Carga Semanal</th>
                                 <th>Valor Hora</th>
                                 <th>Asignado</th>
                                 <th>Descontado</th>
                              </tr>
                           </thead>
                           <tbody>
                              @if(count($cestatickets) == 0)
                              <tr>
                                 <td colspan='12'>No se han encontrado resultados...</td>
                              </tr>
                              @else
                              @foreach($cestatickets as $cestaticket)
                              <tr>
                                 <td>{{$cestaticket->empleado->nombres}} {{$cestaticket->empleado->apellidos}} </td>
                                 <td>{{$cestaticket->empleado->cedula}}</td>
                                 <td>{{$cestaticket->empleado->cargo->abreviatura}}</td>
                                 <td>{{$cestaticket->empleado->horas_semanales}} Horas</td>
                                 <td>{{$cestaticket->cestaticket_valor}} Bs</td>
                                 <td>{{$cestaticket->asignacion}} Bs</td>
                                 <td>{{$cestaticket->faltas}} Horas</td>
                                 <td>
                                    <a href="javascript:cestaticketUpdate('{{url('cestatickets/'.$cestaticket->id)}}')"data-toggle="tooltip" title="Agregar faltas" class="fas fa-calendar-minus"></a>
                                 </td>
                              </tr>
                              @endforeach
                              @endif
                           </tbody>
                        </table>
                     </div>
                     <div class="col-xs-12 text-center margin-top modal-footer">
                        <a type="submit" class="btn btn-primary" id="btn-action-cestaticket" href="{{url('cestatickets/ver/'.$cestaticket->recibo->id)}}">Finalizar</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@include('pages.cestatickets.update')