@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
         <div class="col-lg-6 col-md-7 col-sm-10 col-xs-12 centrado-porcentual" >
            
            <div class='col-xs-12 text-center' style='padding-bottom: 20px;'>
                <img src='{{url("assets/img/Logo.png")}}' alt='IDM' title='IDM' style="height: 100px"/>
            </div>
            <div class='col-xs-12 text-center margin-top' style='height:250px;'>
            <div class="panel panel-default" style="background: rgba(255,255,255,0.2);">
                <div class="panel-heading" style="color:white;font-size:16px;font-weight: 600;text-shadow:1px 1px black;background: rgba(255,255,255,0.2)">Recuperar contraseña</div>
                <div class="panel-body" style="padding-top: 50px;">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label" style="color:white;font-size:16px;font-weight: 600;text-shadow:1px 1px black;"> Ingrese su correo electrónico</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" style="border: 2px;border-radius:0">
                                    Enviar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
