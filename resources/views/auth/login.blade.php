@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-7 col-sm-10 col-xs-12 centrado-porcentual" >
            
            <div class='col-xs-12 text-center' style='padding-bottom: 20px;'>
                <img src='{{url("assets/img/Logo.png")}}'/>
            </div>
            <div class='col-xs-12 text-center margin-top' style='height:250px;'>
            <div class="panel panel-default" style="background: rgba(255, 255, 255, 0.1);">
               
                <div class="panel-body" style="padding-top: 50px;">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('cedula') ? ' has-error' : '' }}">
                            <label for="cedula" class="col-md-4 control-label" style="color:white;font-size:16px;font-weight: 600;text-shadow:1px 1px black;" >Cédula de Identidad</label>

                            <div class="col-md-6">
                                <input id="cedula" type="cedula" class="form-control" name="cedula" value="{{ old('cedula') }}" required autofocus>

                                @if ($errors->has('cedula'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cedula') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label" style="color:white;font-size:16px;font-weight: 600;text-shadow:1px 1px black;">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12 text-center">
                                <button type="submit" class="btn btn-lg btn-primary" style="border: 2px;border-radius:0;">
                                    Ingresar
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
