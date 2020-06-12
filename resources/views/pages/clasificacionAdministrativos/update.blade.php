<script type='text/javascript'>
    function clasificacionAdministrativoUpdate(url) { 
        document.getElementById('clasificacionAdministrativoForm').reset(); 
        $(".loader").removeClass("hidden");
        $("#clasificacionAdministrativoModalForm").addClass("hidden");
        $('[name=_method]').val('PUT');
        $("#clasificacionAdministrativoLabel").html('Editar monto');
        $('#clasificacionAdministrativoForm').attr('action',url);
        $('#btn-action').html('Actualizar');
        $('#btn-action').addClass('btn-success');
        $('#btn-action').removeClass('btn-primary');

        $.get(url,function(data,status){
            data=JSON.parse(data);
            if(data.result) {
                $('#grado').val(data.data.grado);
                $('#nivel').val(data.data.nivel);
                $('#monto').val(data.data.monto);
            }
            $(".loader").addClass("hidden");
            $("#clasificacionAdministrativoModalForm").removeClass("hidden");
        });
        $("#clasificacionAdministrativoModal").modal();
    }   
</script>

<div class="modal fade" id="clasificacionAdministrativoModal" tabindex="-1" role="dialog" aria-labelledby="clasificacionAdministrativoModal" aria-hidden="true">
    <div class="modal-dialog modal-big">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title" id="clasificacionAdministrativoLabel"></h3>
            </div>
            
            <div class="modal-body no-border">
                <div class="col-xs-12">
                    <h4 id="div-inner-title"></h4>
                </div>
                <div class="loader text-center">
                    <i class="fas fa-spinner fa-spin fa-3x fa-fw"></i>
                    <span class="sr-only">Loading...</span>
                </div>

                <div class="col-xs-12" id="clasificacionAdministrativoModalForm">
                    <form class="form-horizontal" id="clasificacionAdministrativoForm" method='POST'>
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="POST">

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                            <label for="nivel">Nivel</label>
                            <input type="text" class="form-control" id="nivel" name="nivel" style="pointer-events: none" placeholder="nivel" value="{{old('nivel')}}"/>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                            <label for="grado">Grado</label>
                            <input type="text" class="form-control" id="grado" name="grado" style="pointer-events: none" placeholder="Grado" value="{{old('grado')}}"/>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                            <label for="monto">Monto Bs</label>
                            <input type="number" class="form-control" id="monto" name="monto" placeholder="Monto" value="{{old('monto')}}" step="0.01" />
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