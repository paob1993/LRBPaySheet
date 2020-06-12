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
                    <h4 class="title">Categorías Docentes</h4>
                </div>
                
                <div class='content'>

                    <div class="table-responsive table-full-width">
                        <table class="table table-hover table-striped table-center">
                            <thead>
                                <tr>
                                   <th>Abreviatura</th>
                                   <th>Categoría</th>
                                   <th>Hasta los</th>
                                   <th>¿Especialización o Postgrado?</th>
                                   <th>Valor por Hora</th>
                                   <th><i class="fa fa-lg- fa-cogs"></i></th>
                               </tr>
                           </thead>
                           <tbody>
                            @if(count($categoriasDocentes) == 0)
                            <tr>
                                <td colspan='12'>No se han encontrado resultados...</td>
                            </tr>
                            @else
                            @foreach($categoriasDocentes as $categoriaDocente)
                            <tr>
                                <td>{{$categoriaDocente->abreviatura}}</td>
                                <td>{{$categoriaDocente->categoria}}</td>
                                <td>{{$categoriaDocente->anos}} años</td>
                                <td>{{$categoriaDocente->esp_post == 1 ? 'Si' : 'No'}}</td>
                                <td>Bs. {{$categoriaDocente->valor_hora}}</td>
                                <td>
                                    <a class="color-edit" href="javascript:categoriaDocenteUpdate('{{url('categoriasDocentes/'.$categoriaDocente->id)}}')" title="Editar Valor por Hora" data-toggle="tooltip"><i class="fas fa-pencil-alt" aria-hidden='true'></i></a>
                                </td>
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
@stop
@include('pages.categoriasDocentes.update')