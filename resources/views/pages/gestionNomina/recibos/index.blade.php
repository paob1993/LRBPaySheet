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
                    <h4 class="title">Recibo {{$recibo->mes}}-{{$recibo->ano}}</h4>
                    <p class="category">
                        <div class='col-xs-12'>
                            <p class='pull-right'>
                                <a id="download_button"class='btn btn-success' href="{{url('exportar/archivoBanco/primeraQuincena/'.$recibo->id)}}">Descargar <i class='fa fa-lg fa-download'></i></a>
                            </p>
                        </div>
                    </p>
                </div>
                
                <div class='content'>                    

                    <div class="table-responsive table-full-width">
                        <table class="table table-hover table-striped table-center">
                            <thead>
                                <tr>
                                   <th>Nombres y Apellidos</th>
                                   <th>Cédula</th>
                                   <th>Cargo</th>
                                   <th>Monto Total</th>
                                   <th>Primera Quincena</th>
                               </tr>
                           </thead>
                           <tbody>
                            @if(count($recibo->recibosEmpleados) == 0)
                            <tr>
                                <td colspan='12'>No se han encontrado resultados...</td>
                            </tr>
                            @else
                            @foreach($recibo->recibosEmpleados as $recEmpleado)
                            <tr>
                                <td>{{$recEmpleado->empleado->nombres}} {{$recEmpleado->empleado->apellidos}}</td>
                                <td>{{$recEmpleado->empleado->cedula}}</td>
                                <td>{{$recEmpleado->empleado->cargo->descripcion}}</td>
                                <td>{{$recEmpleado->monto_total}}</td>
                                <td>{{$recEmpleado->primer_quincena}}</td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="text-center">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop