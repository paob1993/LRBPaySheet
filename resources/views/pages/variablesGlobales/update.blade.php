<script type='text/javascript'>
    function variablesGlobalesUpdate(url) {  
        document.getElementById('variablesGlobalesForm').reset(); 
        $(".loader").removeClass("hidden");
        $("#variablesGlobalesModalForm").addClass("hidden");
        $('#variablesGlobalesForm').attr('action',url);
        $("#variablesGlobalesLabel").html('Editar Variables Globales');
        $("#btn-action").html('Actualizar');
        $("#btn-action").addClass('btn-success');
        $("#btn-action").removeClass('btn-primary');        
        $('[name=_method]').val('PUT');

        $.get(url,function(data,status){
            data=JSON.parse(data);
            if(data.result) {
                $("#descripcion").val(data.data.descripcion);
                $("#cantidad").val(data.data.cantidad);
                $("#formula").val(data.data.formula);
                $("#tipo_valor").val(data.data.tipo_valor);
                for (var i = data.data.variables_globales_tipos_empleado.length - 1; i >= 0; i--) {
                    if (data.data.variables_globales_tipos_empleado[i].tipo_empleado === 1){
                        $("#valor_administrativo").val(data.data.variables_globales_tipos_empleado[i].cantidad);                        
                    }
                    if (data.data.variables_globales_tipos_empleado[i].tipo_empleado === 2){
                        $("#valor_obrero").val(data.data.variables_globales_tipos_empleado[i].cantidad);
                    }
                    if (data.data.variables_globales_tipos_empleado[i].tipo_empleado === 3){
                        $("#valor_docente").val(data.data.variables_globales_tipos_empleado[i].cantidad); 
                    }
                }   
            }
            $(".loader").addClass("hidden");
            $("#variablesGlobalesModalForm").removeClass("hidden");
        });
        $("#modalVariablesGlobales").modal();
    }
</script>

<div class="modal fade" id="modalVariablesGlobales" tabindex="-1" role="dialog" aria-labelledby="modalVariablesGlobales" aria-hidden="true">
    <div class="modal-dialog modal-big">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title" id="variablesGlobalesLabel"></h3>
            </div>
            
            <div class="modal-body no-border">
                <div class="col-xs-12">
                    <h4 id="div-inner-title"></h4>
                </div>
                <div class="loader text-center">
                    <i class="fas fa-spinner fa-spin fa-3x fa-fw"></i>
                    <span class="sr-only">Loading...</span>
                </div>

                <div class="col-xs-12" id="variablesGlobalesModalForm">
                    <form class="form-horizontal" id="variablesGlobalesForm" method='POST'>
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="POST">

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                            <label for="descripcion">Descripción: </label>
                            <input type="text" class="form-control" id="descripcion" style="pointer-events: none" />
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                            <label for="formula">Fórmula a la que Aplica</label>
                            <select class="form-control" id="formula" style="pointer-events: none">
                                @foreach(\App\OwnModels\OwnArrays::$formulas as $key => $value)
                                <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                            <label for="tipo_valor">Tipo de Valor</label>
                            <select class="form-control" id="tipo_valor" style="pointer-events: none">
                                @foreach(\App\OwnModels\OwnArrays::$tipos_valor as $key => $value)
                                <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                            <label for="valor_administrativo">Valor para Administrativo</label>
                            <input type="number" class="form-control" id="valor_administrativo" name="valor_administrativo" step="0.0001"/>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                            <label for="valor_obrero">Valor para Obrero</label>
                            <input type="number" class="form-control" id="valor_obrero" name="valor_obrero" step="0.0001"/>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                            <label for="valor_docente">Valor para Docente</label>
                            <input type="number" class="form-control" id="valor_docente" name="valor_docente" step="0.0001"/>
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