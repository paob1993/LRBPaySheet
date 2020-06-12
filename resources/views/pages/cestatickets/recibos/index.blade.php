<script>

document.addEventListener('DOMContentLoaded',function() {
    document.querySelector('select[name="id_recibo"]').onchange=changeEventHandler;
},false);

function changeEventHandler(event) {
    var url = "{{url('exportar/cestatickets')}}"+"/"+event.target.value;
    $('#download_button').attr('href', url);
}
</script>

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
                    <h4 class="title">Recibo de Cestaticket {{$recibo->mes}}-{{$recibo->ano}}</h4>
                    <p class="category">
                        <div class='col-xs-12'>
                            <p class='pull-right'>
                                <a id="download_button"class='btn btn-success' href="{{url('exportar/archivoBanco/cestatickets/'.$recibo->id)}}">Descargar <i class='fa fa-lg fa-download'></i></a>
                            </p>
                        </div>
                    </p>
                </div>
                
                <div class='content'>

                    <div class="table-responsive table-full-width">
                        <table class="table table-hover table-striped table-center">
                            <thead>
                                <tr>
                                   <th>Empleado</th>
                                   <th>Cédula</th>
                                   <th>Cargo</th>
                                   <th>Monto Mes</th>
                                   <th>Despositado</th>
                                   <th>Descontado</th>
                               </tr>
                            </thead>
                            <tbody>
                               @if(count($recibo->cestatickets) == 0)
                                <tr>
                                    <td colspan='12'>No se han encontrado resultados...</td>
                                </tr>
                                @else
                                @foreach($recibo->cestatickets as $cestaticket)
                                <tr>
                                <td>{{$cestaticket->empleado->nombres}} {{$cestaticket->empleado->apellidos}} </td>
                                <td>{{$cestaticket->empleado->cedula}}</td>
                                <td>{{$cestaticket->empleado->cargo->descripcion}}</td>
                                <td>{{$cestaticket->tickets_mes}}</td>
                                <td>{{$cestaticket->asignacion}} Bs</td>
                                <td>{{$cestaticket->faltas}} Horas</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop