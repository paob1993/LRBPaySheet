@extends('layouts.dashboard.default')
@section('content')
<div class="container-fluid">
   <div class="row">
      <div class='col-md-12 no-padding'>
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
         <h4 class="title text-center" style="font-weight: 600;">Nómina:</h4>
      </div>
      <div class='content'>
         <div class="col-md-12">
            <div class="card" style="box-shadow: 0 1px 2px rgba(0, 0, 0, 0.00), 0 0 0 1px rgba(63, 63, 68, 0);">
               <div class="card-header">
                  <h5 class="title"><span style="font-weight: 600;"> 1er. Paso:</span> Escoger el Periodo de Facturación</h5>
               </div>
               <div class="card-body ">
                  <!-- Paso 1 -->
                  <form class='form-horizontal' method='POST' action="..\recibosEmpleados">
                     {!! csrf_field() !!}
                     <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                        <label for="mes">Mes</label>
                        <select class="form-control" name="mes" id="mes">
                           @foreach(\App\OwnModels\Utilidades::$months as $key => $value)
                           @if($key == old('mes'))
                           <option value="{{$key}}" selected>{{$value}}</option>
                           @else
                           <option value="{{$key}}">{{$value}}</option>
                           @endif
                           @endforeach
                        </select>
                     </div>
                     <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                        <label for="ano">Año</label>
                        <select class="form-control" name="ano" id="ano">
                           <option value="{{Carbon\Carbon::now()->subYear()->year}}">{{Carbon\Carbon::now()->subYear()->year}}</option>
                           <option value="{{Carbon\Carbon::now()->year}}" selected>{{Carbon\Carbon::now()->year}}</option>
                           <option value="{{Carbon\Carbon::now()->addYear()->year}}">{{Carbon\Carbon::now()->addYear()->year}}</option>
                        </select>
                     </div>
                     <div class="col-xs-12 text-center margin-top modal-footer">
                        <button type="submit" class="btn btn-primary" id="btn-action-nomina">Siguiente</button>
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