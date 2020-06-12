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
                    <h4 class="title">Cestatickets</h4>
                </div>
                
                <div class='content'>
                    <form class='form-horizontal' method='GET'>

                        
                        <div class='col-lg-3 col-md-6 col-xs-12 margin-top div-fix-height'>
                            <label for="id_recibo">Recibo <a data-toggle="tooltip" title="Filtrar por recibo"><i class="fa fa-lg fa-info-circle" style="color:#56AEFF;cursor:pointer;" aria-hidden="true"></i></a></label>
                            <select class="form-control" name="id_recibo" id="id_recibo">
                                <option value="" selected>Selecciona</option>
                                @foreach($recibos as $recibo)
                                @if($id_recibo == $recibo->id)
                                <option value="{{$recibo->id}}" selected>{{$recibo->mes}} - {{$recibo->ano}}</option>
                                @else
                                <option value="{{$recibo->id}}">{{$recibo->mes}} - {{$recibo->ano}}</option>
                                @endif
                                @endforeach
                            </select>
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
                            <a id="download_button"class='btn btn-success' href="{{url('exportar/cestatickets/'.$id_recibo)}}">Descargar <i class='fa fa-lg fa-download'></i></a>
                        </div>
                        
                    </form>

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
                               @if(count($cestatickets) == 0)
                                <tr>
                                    <td colspan='12'>No se han encontrado resultados...</td>
                                </tr>
                                @else
                                @foreach($cestatickets as $cestaticket)
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
                        <div class="text-center">{{$cestatickets->appends([
                            'cantidad' => $busqueda_cantidad, 
                            'id_recibo' => $id_recibo,
                            ])->render()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop