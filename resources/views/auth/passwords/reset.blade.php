<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{url('assets/img/favicon.ico')}}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'IDM') }}</title>
    
    <!-- Styles -->
    <link href="{{url('css/app.css')}}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <script src="{{url('assets/js/jquery-1.10.2.js')}}" type="text/javascript"></script>
    
    
    <style>
            .centrado-porcentual {
                position: absolute;
                left: 50%;
                top: 40%;
                transform: translate(-50%, -50%);
                -webkit-transform: translate(-50%, -50%);
            }
   

             html{
                background: url(../assets/img/idmm.jpeg) no-repeat center center fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }

 </style>


    
</head>
<body >
    <div id="app">
        <div class="container">
    <div class="row">
         <div class="col-lg-6 col-md-7 col-sm-10 col-xs-12 centrado-porcentual" >
            <div class='col-xs-12 text-center' style='padding-bottom: 20px;'>
                <img src='{{url("assets/img/Logo.png")}}' alt='IDM' title='IDM' style="height: 100px"/>
            </div>
            <div class='col-xs-12 text-center margin-top' style='height:250px;'>
            <div class="panel panel-default" style="background: rgba(255,255,255,0.2);">
                <div class="panel-heading" style="color:white;font-size:16px;font-weight: 600;text-shadow:1px 1px black;background: rgba(255,255,255,0.2)">Recuperar Contraseña</div>

                  <div class="panel-body" style="padding-top: 50px;">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('password.request') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label" style="color:white;font-size:16px;font-weight: 600;text-shadow:1px 1px black;">Correo electrónico:</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label" style="color:white;font-size:16px;font-weight: 600;text-shadow:1px 1px black;">Nueva contraseña:</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label" style="color:white;font-size:16px;font-weight: 600;text-shadow:1px 1px black;">Confirme contraseña:</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" style="border: 2px;border-radius:0">
                                    Recuperar
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
    </div>

    <!-- Scripts -->
    <script src="{{url('js/app.js')}}"></script>
    
    <script src="{{url('assets/js/funciones.js')}}" type="text/javascript"></script>
</body>
</html>



