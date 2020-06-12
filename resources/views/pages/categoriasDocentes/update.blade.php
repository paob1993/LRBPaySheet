<script type='text/javascript'>
    function categoriaDocenteUpdate(url) { 
        document.getElementById('categoriaDocenteForm').reset(); 
        $(".loader").removeClass("hidden");
        $("#categoriaDocenteModalForm").addClass("hidden");
        $('[name=_method]').val('PUT');
        $("#categoriaDocenteLabel").html('Editar Valor por Hora');
        $('#categoriaDocenteForm').attr('action',url);
        $('#btn-action').html('Actualizar');
        $('#btn-action').addClass('btn-success');
        $('#btn-action').removeClass('btn-primary');

        $.get(url,function(data,status){
            data=JSON.parse(data);
            if(data.result) {
                $('#abreviatura').val(data.data.abreviatura);
                $('#categoria').val(data.data.categoria);
                $('#anos').val(data.data.anos + ' años');
                data.data.esp_post == 1 ? $('#esp_post').val('Sí') : $('#esp_post').val('No');
                $('#valor_hora').val(data.data.valor_hora);
            }
            $(".loader").addClass("hidden");
            $("#categoriaDocenteModalForm").removeClass("hidden");
        });
        $("#modalCategoriaDocente").modal();
    }   
</script>

<div class="modal fade" id="modalCategoriaDocente" tabindex="-1" role="dialog" aria-labelledby="modalCategoriaDocente" aria-hidden="true">
    <div class="modal-dialog modal-big">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title" id="categoriaDocenteLabel"></h3>
            </div>
            
            <div class="modal-body no-border">
                <div class="col-xs-12">
                    <h4 id="div-inner-title"></h4>
                </div>
                <div class="loader text-center">
                    <i class="fas fa-spinner fa-spin fa-3x fa-fw"></i>
                    <span class="sr-only">Loading...</span>
                </div>

                <div class="col-xs-12" id="categoriaDocenteModalForm">
                    <form class="form-horizontal" id="categoriaDocenteForm" method='POST'>
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="POST">

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                            <label for="abreviatura">Abreviatura</label>
                            <input type="text" class="form-control" id="abreviatura" name="abreviatura" style="pointer-events: none" placeholder="Abreviatura" value="{{old('abreviatura')}}"/>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                            <label for="categoria">Categoría</label>
                            <input type="text" class="form-control" id="categoria" name="categoria" style="pointer-events: none" placeholder="Categoría" value="{{old('categoria')}}"/>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                            <label for="anos">Hasta los</label>
                            <input type="text" class="form-control" id="anos" name="anos" style="pointer-events: none" placeholder="Categoría" value="{{old('anos')}}"/>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                            <label for="esp_post">¿Requiere Especialización o Postgrado?</label>
                            <input type="text" class="form-control" id="esp_post" name="esp_post" style="pointer-events: none" placeholder="Categoría" value="{{old('esp_post')}}"/>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                            <label for="valor_hora">Valor por hora</label>
                            <input type="number" class="form-control" id="valor_hora" name="valor_hora" placeholder="Valor por Hora" value="{{old('valor_hora')}}" step="0.01" />
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