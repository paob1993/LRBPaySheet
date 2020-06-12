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
            <h4 class="title">Clasificación Obreros</h4>
            <p class="category">
            <div class='col-xs-12'>
               <p class='pull-right'>
                  <a class="btn btn-primary link-no-style" href="javascript:clasificacionObreroUpdateAll('{{url('clasificacionObreros/updateAll')}}')" title="Editar Todos">Editar Todos <i class="fas fa-pencil-alt" aria-hidden='true'></i></a>
               </p>
            </div>
            </p>
         </div>
         <div class='content'>
            <form class='form-horizontal' method='GET'>
               <div class='col-lg-3 col-md-6 col-xs-12 margin-top div-fix-height'>
                  <label for="grado">Grado <a data-toggle="tooltip" title="Buscar por grado"><i class="fa fa-lg fa-info-circle" style="color:#56AEFF;cursor:pointer;" aria-hidden="true"></i></a></label>
                  <input type="number" class="form-control"id="grado" name="grado" min="1" value="{{$grado}}" />
               </div>
               <div class='col-lg-3 col-md-6 col-xs-12 margin-top div-fix-height'>
                  <label for="paso">Paso <a data-toggle="tooltip" title="Buscar por paso"><i class="fa fa-lg fa-info-circle" style="color:#56AEFF;cursor:pointer;" aria-hidden="true"></i></a></label>
                  <input type="number" class="form-control" id="paso" name="paso" min="1" value="{{$paso}}" />
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
                        <th>Paso</th>
                        <th>Grado</th>
                        <th>Monto Bs</th>
                        <th><i class="fa fa-lg- fa-cogs"></i></th>
                     </tr>
                  </thead>
                  <tbody>
                     @if(count($clasificacionObreros) == 0)
                     <tr>
                        <td colspan='12'>No se han encontrado resultados...</td>
                     </tr>
                     @else
                     @foreach($clasificacionObreros as $clasificacionObrero)
                     <tr>
                        <td>{{$clasificacionObrero->grado}}</td>
                        <td>{{$clasificacionObrero->paso}}</td>
                        <td>{{$clasificacionObrero->monto}}</td>
                        <td>
                           <a class="color-edit" href="javascript:clasificacionObreroUpdate('{{url('clasificacionObreros/'.$clasificacionObrero->id)}}')" data-toggle="tooltip" title="Editar Monto"><i class="fas fa-pencil-alt" aria-hidden='true'></i></a>
                        </td>
                     </tr>
                     @endforeach
                     @endif
                  </tbody>
               </table>
               <div class="text-center">{{$clasificacionObreros->appends([
                  'cantidad' => $busqueda_cantidad, 
                  'grado' => $grado, 
                  'paso' => $paso
                  ])->render()}}
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@stop
@include('pages.clasificacionObreros.update')
@include('pages.clasificacionObreros.updateAll')