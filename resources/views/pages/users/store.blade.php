<script type='text/javascript'>
    function usuarioStore(url, empleado_id, empleado_cedula, empleado_cargo) {  
        document.getElementById('usuarioForm').reset(); 
        $('#usuarioForm').attr('action',url);
        $("#usuarioLabel").html('Nuevo Usuario');
        $("#btn-action").html('Agregar');
        $("#btn-action").addClass('btn-primary');
        $("#btn-action").removeClass('btn-success');

        $('#password').attr('required',true);
        $('#empleado_id').val(empleado_id);
        $('#cedula').val(empleado_cedula);
        $('#cedula').css('pointer-events','none');
        $('#cargo').val(empleado_cargo);
        $('#cargo').css('pointer-events','none');

        $(".loader").addClass("hidden");
        $("#usuarioModalForm").removeClass("hidden");
        $("#modalUsuario").modal();
    }
</script>

<div class="modal fade" id="modalUsuario" tabindex="-1" role="dialog" aria-labelledby="modalUsuario" aria-hidden="true">
    <div class="modal-dialog modal-big">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title" id="usuarioLabel"></h3>
            </div>
            
            <div class="modal-body no-border">
                <div class="col-xs-12">
                    <h4 id="div-inner-title"></h4>
                </div>
                <div class="loader text-center">
                    <i class="fas fa-spinner fa-spin fa-3x fa-fw"></i>
                    <span class="sr-only">Loading...</span>
                </div>

                <div class="col-xs-12" id="usuarioModalForm">
                    <form class="form-horizontal" id="usuarioForm" method='POST'>
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="POST">
                        <input type="hidden" name="empleado_id" id="empleado_id">

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                            <label for="cedula">Cédula</label>
                            <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Cédula" maxlength="{{\App\User::MAX_LENGTH_CEDULA}}" value="{{old('cedula')}}" />
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                            <label for="cargo">Cargo</label>
                            <input type="text" class="form-control" id="cargo" name="cargo" placeholder="Cargo" value="{{old('cargo')}}" />
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                            <label for="rol_id">Rol:</label>
                            <select class="form-control" name="rol_id" id="rol_id">
                                <option value="0" selected>Selecciona</option>
                                @foreach(\App\Models\Rol::$tipos as $key => $value)
                                @if($key == old('rol_id'))
                                    <option value="{{$key}}" selected>{{$value}}</option>
                                @else
                                    <option value="{{$key}}">{{$value}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                            <label for="password">Contraseña</label>
                            <input type="text" class="form-control" id="password" name="password" placeholder="Contrseña" maxlength="{{\App\User::MAX_LENGTH_PASSWORD}}" value="{{old('password')}}" />
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