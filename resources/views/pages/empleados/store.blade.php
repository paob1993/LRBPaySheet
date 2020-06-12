<script type='text/javascript'>
    function empleadoStore(url) {  
        document.getElementById('empleadoForm').reset(); 
        $('#empleadoForm').attr('action',url);
        $('[name=_method]').val('POST');
        $('#empleadoLabel').html('Nuevo Empleado');
        $('#btn-action').html('Agregar');
        $('#btn-action').addClass('btn-primary');
        $('#btn-action').removeClass('btn-success');
        $('#fecha_ingreso').datepicker({dateFormat: 'dd/mm/yy', autoclose:true, todayHighlight:true});
        $('#fecha_ingreso').val('');
        $('.loader').addClass('hidden');
        $('#empleadoModalForm').removeClass('hidden');
        $('#modalEmpleado').modal();

        $('#nombres').attr('required',true);
        $('#apellidos').attr('required',true);
        $('#cedula').attr('required',true);
        $('#fecha_ingreso').attr('required',true);
        $('#horas_semanales').attr('required',true);
        $('#tipo_personal').attr('required',true);
        $('#cargo').attr('required',true);
        $('#prestaciones_sociales_acumuladas').attr('required',true);

        tipoEmpleado(0);
    }
    function tipoEmpleado(cargoId) {
        $('.loader').removeClass('hidden');
        $('#empleadoModalForm').addClass('hidden');
        if (cargoId !== 0) {
            $.get('{{url('cargos/tipoEmpleado')}}'+'/'+cargoId,function(data,status){
                data=JSON.parse(data);
                if (data) {
                    $('#tipo_empleado').val(data.data);
                    if(data.data == 3){
                        $('#docente').css('display', 'block');
                        $('#obradm').css('display', 'none');
                        $('#obr').css('display', 'none');
                        $('#adm').css('display', 'none');
                        $('#titulo_docente').attr('required',true);
                        $('#nivel_instruccion').attr('required',false);
                        $('#nivel_instruccion').val(1);
                        $('#clasificacion_administrativa').attr('required',false);
                        $('#clasificacion_administrativa').val(1);
                        $('#clasificacion_obrera').attr('required',false);
                        $('#clasificacion_obrera').val(1);
                    } else {
                        $('#docente').css('display', 'none');
                        $('#titulo_docente').attr('required',false);
                        $('#titulo_docente').val(1);
                        $('#nivel_instruccion').attr('required',true);                   
                        if (data.data == 2) {
                            $('#obradm').css('display', 'block');
                            $('#obr').css('display', 'block');
                            $('#adm').css('display', 'none');
                            $('#clasificacion_administrativa').attr('required',false);
                            $('#clasificacion_administrativa').val(1);
                            $('#clasificacion_obrera').attr('required',true);
                        } else {
                            $('#obradm').css('display', 'block');
                            $('#obr').css('display', 'none');
                            $('#adm').css('display', 'block');
                            $('#clasificacion_administrativa').attr('required',true);
                            $('#clasificacion_obrera').attr('required',false);
                            $('#clasificacion_obrera').val(1);
                        }
                    }
                }
                $('.loader').addClass('hidden');
                $('#empleadoModalForm').removeClass('hidden');
            });
        } else {
            $('#docente').css('display', 'none');
            $('#obradm').css('display', 'none');
            $('#obr').css('display', 'none');
            $('#adm').css('display', 'none');
            $('#titulo_docente').attr('required',false);
            $('#titulo_docente').val("");
            $('#nivel_instruccion').attr('required',false);
            $('#nivel_instruccion').val("");
            $('#clasificacion_administrativa').attr('required',false);
            $('#clasificacion_administrativa').val("");
            $('#clasificacion_obrera').attr('required',false);
            $('#clasificacion_obrera').val("");
            $('.loader').addClass('hidden');
            $('#empleadoModalForm').removeClass('hidden');
        }
    }
</script>

<div class="modal fade" id="modalEmpleado" tabindex="-1" role="dialog" aria-labelledby="modalEmpleado" aria-hidden="true">
    <div class="modal-dialog modal-big">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title" id="empleadoLabel"></h3>
            </div>
            
            <div class="modal-body no-border">
                <div class="col-xs-12">
                    <h4 id="div-inner-title"></h4>
                </div>
                <div class="loader text-center">
                    <i class="fas fa-spinner fa-spin fa-3x fa-fw"></i>
                    <span class="sr-only">Loading...</span>
                </div>

                <div class="col-xs-12" id="empleadoModalForm">
                    <form class="form-horizontal" id="empleadoForm" method='POST'>
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="POST">
                        <input type="hidden" id="tipo_empleado" name="tipo_empleado">

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                            <label for="nombres">Nombres</label>
                            <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Nombres" maxlength="{{\App\Models\Empleado::MAX_LENGTH_NOMBRES}}" value="{{old('nombres')}}"/>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                            <label for="apellidos">Apellidos</label>
                            <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos" maxlength="{{\App\Models\Empleado::MAX_LENGTH_APELLIDOS}}" value="{{old('apellidos')}}"/>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                            <label for="cedula">Cédula de Identidad</label>
                            <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Cédula de Identidad" maxlength="{{\App\Models\Empleado::MAX_LENGTH_CEDULA}}" value="{{old('cedula')}}"/>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                            <label for="fecha_ingreso">Fecha de Ingreso</label>
                            <input class="form-control" id="fecha_ingreso" name="fecha_ingreso" placeholder="Fecha de Ingreso"/>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                            <label for="horas_semanales">Horas Semanales</label>
                            <input type="number" class="form-control" id="horas_semanales" name="horas_semanales" placeholder="Horas Semanales" value="{{old('horas_semanales')}}" step="0.01"/>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                            <label for="titulo_docente">Seleccione si va a ser ser descontado:</label>
                            <br>
                            <input class="form-check-input" type="checkbox" value="1" name="sso" id="sso"><span class="form-check-sign"> SSO</span>
                            <br>
                            <input class="form-check-input" type="checkbox" value="1" name="lph" id="lph"><span class="form-check-sign"> LPH</span>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                            <label for="tipo_personal">Tipo Personal</label>
                            <select class="form-control" name="tipo_personal" id="tipo_personal">
                                <option value="">Selecciona</option>
                                @foreach(\App\OwnModels\OwnArrays::$tipos_de_personal as $key => $value)
                                <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                            <label for="cargo">Cargo</label>
                            <select class="form-control" name="cargo_id" id="cargo" onchange="tipoEmpleado(value)">
                                <option value="">Selecciona</option>
                                @foreach($cargos as $key)
                                <option value="{{$key->id}}">{{$key->descripcion}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div id="docente" style="display: none"> 

                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                                <label for="titulo_docente">Título</label>
                                <select class="form-control" name="titulo_docente" id="titulo_docente">
                                    <option value="">Selecciona</option>
                                    @foreach(\App\OwnModels\OwnArrays::$descripciones_titulos as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                                <label for="titulo_docente">¿Posee alguna de las siguientes?</label>
                                <br>
                                <input class="form-check-input" type="checkbox" value="1" name="postgrado" id="postgrado"><span class="form-check-sign"> Postgrado</span>
                                <br>
                                <input class="form-check-input" type="checkbox" value="1" name="especializacion" id="especializacion"><span class="form-check-sign"> Especialización</span>
                            </div>

                        </div>

                        <div id="obradm" style="display: none">   

                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                                <label for="nivel_instruccion">Nivel de Instrucción</label>
                                <select class="form-control" name="nivel_instruccion" id="nivel_instruccion">
                                    <option value="">Selecciona</option>
                                    @foreach(\App\OwnModels\OwnArrays::$niveles_instruccion as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div id="obr" style="display: none">                            

                                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                                    <label for="clasificacion_obrera">Clasificación (Grado-Paso)</label>
                                    <select class="form-control" name="clasificacion_obrero_id" id="clasificacion_obrera">
                                        <option value="">Selecciona</option>
                                        @foreach($clasificaciones_obreras as $key)
                                        <option value="{{$key->id}}">{{$key->grado}}-{{$key->paso}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <div id="adm" style="display: none">                           

                                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                                    <label for="clasificacion_administrativa">Clasificación (Grado-Nivel)</label>
                                    <select class="form-control" name="clasificacion_administrativo_id" id="clasificacion_administrativa">
                                        <option value="">Selecciona</option>
                                        @foreach($clasificaciones_administrativas as $key)
                                        <option value="{{$key->id}}">{{$key->grado}}-{{$key->nivel}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>                            

                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                            <label for="prestaciones_sociales_acumuladas">Prestaciones Sociales Acumuladas (Bs.)</label>
                            <input type="number" class="form-control" id="prestaciones_sociales_acumuladas" name="prestaciones_sociales_acumuladas" placeholder="Prestaciones Sociales Acumuladas" value="{{old('prestaciones_sociales_acumuladas')}}" step="0.01"/>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                            <label for="tiempo_completo">Es un Empleado de Tiempo Completo:</label>
                            <br>
                            <input class="form-check-input" type="radio" value="1" name="tiempo_completo"><span class="form-check-sign"> Sí</span>
                            <br>
                            <input class="form-check-input" type="radio" value="0" name="tiempo_completo" checked="true"><span class="form-check-sign"> No</span>
                        </div>

                        <div class="col-xs-12 text-center margin-top modal-footer">
                            <button type="submit" class="btn" id="btn-action"></button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
                
                <div class="col-xs-12 div-center" id="divModalStoreResp"></div>
            </div>

            <div class="modal-footer no-border"></div>
        </div>
    </div>
</div>