<script type='text/javascript'>
    function usuarioUpdate(url) {  
        document.getElementById('usuarioForm').reset(); 
        $(".loader").removeClass("hidden");
        $("#usuarioModalForm").addClass("hidden");
        $('#usuarioForm').attr('action',url);
        $("#usuarioLabel").html('Editar Usuario');
        $("#btn-action").html('Actualizar');
        $("#btn-action").addClass('btn-success');
        $("#btn-action").removeClass('btn-primary');        
        $('[name=_method]').val('PUT');

        $('#cedula').css('pointer-events','none');
        $('#cargo').css('pointer-events','none');
        $('#rol_id').css('pointer-events','none');

        $.get(url,function(data,status){
            data=JSON.parse(data);
            if(data.result) {
                $('#cargo').val(data.data.empleado.cargo.descripcion);
                $('#empleado_id').val(data.data.empleado.id);
                $('#rol_id').val(data.data.rol.id);
                $('#cedula').val(data.data.cedula);                
            }
            $(".loader").addClass("hidden");
            $("#usuarioModalForm").removeClass("hidden");
        });
        $("#modalUsuario").modal();
    }
</script>