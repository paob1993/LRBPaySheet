<script type='text/javascript'>
    function empleadoDelete(url, nombres, apellidos, cedula) {
        $("#modalEmpleadoDelete").find('#formDelete').attr('action',url);
        $("#modalEmpleadoDelete").find('#div-inner-title').html('¿Está seguro que desea eliminar el empleado: '+nombres+' '+apellidos+' (C.I: '+cedula+')?');        
        $("#modalEmpleadoDelete").modal();
    }
</script>
<div class="modal fade" id="modalEmpleadoDelete" tabindex="-1" role="dialog" aria-labelledby="modalEmpleadoDelete" aria-hidden="true">
    <div class="modal-dialog modal-big">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title" id="modalEmpleadoDelete">Eliminar Empleado</h3>
            </div>

            <div class="modal-body no-border">
                <div class="col-xs-12">
                     <h4 id="div-inner-title"></h4>
                </div>
                <div class="col-xs-12" id="divModalDelete"></div>
                <div class="col-xs-12 div-center" id="divModalDeleteResp"></div>
            </div>

            <div class="modal-footer no-border">
                <form class="form-horizontal" id="formDelete" method='POST'>
                    {!! csrf_field() !!}
                    {!! method_field('DELETE') !!}
                    
                    <button type="submit" class="btn btn-danger" id="btn-action" >Eliminar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
