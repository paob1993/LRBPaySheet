<script type='text/javascript'>
    function registroNominaStore(url, url_update, empleado_id, empleado, recibo_id) {
        document.getElementById('registroNominaForm').reset(); 
        $('#registroNominaForm').attr('action',url);
        $('[name=_method]').val('POST');
        $('#registroNominaLabel').html('Añadir Códigos Manuales a: '+empleado);
        $('#empleado_id').val(empleado_id);
        $('#btn-action').html('Agregar');
        $('#btn-action').addClass('btn-primary');
        $('#btn-action').removeClass('btn-success');
        $('.loader').removeClass('hidden');
        $('#registroNominaModalForm').addClass('hidden');
        $.get(url_update,function(data,status){
            data=JSON.parse(data);
            if(data.result) {
                for (var i = data.data.length - 1; i >= 0; i--) {                  
                    $('#man-'+data.data[i].registroNomina_id).val(data.data[i].cantidad); 
                }         
            }
            $('.loader').addClass('hidden');
            $('#registroNominaModalForm').removeClass('hidden');
        });
        $('#modalRegistroManual').modal();
    }
</script>

<div class="modal fade" id="modalRegistroManual" tabindex="-1" role="dialog" aria-labelledby="modalRegistroManual" aria-hidden="true">
    <div class="modal-dialog modal-big">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title" id="registroNominaLabel"></h3>
            </div>
            
            <div class="modal-body no-border">
                <div class="col-xs-12">
                    <h4 id="div-inner-title"></h4>
                </div>
                <div class="loader text-center">
                    <i class="fas fa-spinner fa-spin fa-3x fa-fw"></i>
                    <span class="sr-only">Loading...</span>
                </div>

                <div class="col-xs-12" id="registroNominaModalForm">
                    <form class="form-horizontal" id="registroNominaForm" method='POST'>
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="POST">
                        <input type="hidden" name="recibo_id" value="{{$recibo_id}}">
                        <input type="hidden" name="empleado_id" id="empleado_id">     

                        @foreach($registros_nomina_manuales as $manual)
                        <input type="hidden" name="{{$manual->id}}-select" value="on">
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                            <label for="{{$manual->nombre}}">{{$manual->nombre}}</label>
                            <input type="number" class="form-control" id="man-{{$manual->id}}" name="{{$manual->id}}" placeholder="{{$manual->nombre}}" value="0" step="0.01"/>
                        </div>
                        @endforeach

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