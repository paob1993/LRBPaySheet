<script type='text/javascript'>
    function clasificacionObreroUpdate(url) { 
        document.getElementById('clasificacionObreroForm').reset(); 
        $(".loader").removeClass("hidden");
        $("#clasificacionObreroModalForm").addClass("hidden");
        $('[name=_method]').val('PUT');
        $("#clasificacionObreroLabel").html('Editar monto');
        $('#clasificacionObreroForm').attr('action',url);
        $('#btn-action').html('Actualizar');
        $('#btn-action').addClass('btn-success');
        $('#btn-action').removeClass('btn-primary');

        $.get(url,function(data,status){
            data=JSON.parse(data);
            if(data.result) {
                $('#grado').val(data.data.grado);
                $('#paso').val(data.data.paso);
                $('#monto').val(data.data.monto);
            }
            $(".loader").addClass("hidden");
            $("#clasificacionObreroModalForm").removeClass("hidden");
        });
        $("#clasificacionObreroModal").modal();
    }   
</script>

<div class="modal fade" id="clasificacionObreroModal" tabindex="-1" role="dialog" aria-labelledby="clasificacionObreroModal" aria-hidden="true">
    <div class="modal-dialog modal-big">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title" id="clasificacionObreroLabel"></h3>
            </div>
            
            <div class="modal-body no-border">
                <div class="col-xs-12">
                    <h4 id="div-inner-title"></h4>
                </div>
                <div class="loader text-center">
                    <i class="fas fa-spinner fa-spin fa-3x fa-fw"></i>
                    <span class="sr-only">Loading...</span>
                </div>

                <div class="col-xs-12" id="clasificacionObreroModalForm">
                    <form class="form-horizontal" id="clasificacionObreroForm" method='POST'>
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="POST">

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                            <label for="paso">Paso</label>
                            <input type="number" class="form-control" id="paso" name="paso" style="pointer-events: none" placeholder="paso" value="{{old('paso')}}"/>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                            <label for="grado">Grado</label>
                            <input type="number" class="form-control" id="grado" name="grado" style="pointer-events: none" placeholder="grado" value="{{old('grado')}}"/>
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