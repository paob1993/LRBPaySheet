<script type='text/javascript'>
    function cargoUpdate(url) { 
        document.getElementById('cargoForm').reset(); 
        $(".loader").removeClass("hidden");
        $("#cargoModalForm").addClass("hidden");
        $('[name=_method]').val('PUT');
        $("#cargoLabel").html('Editar Cargo');
        $('#cargoForm').attr('action',url);
        $('#btn-action').html('Actualizar');
        $('#btn-action').addClass('btn-success');
        $('#btn-action').removeClass('btn-primary');

        $.get(url,function(data,status){
            data=JSON.parse(data);
            if(data.result) {
                $('#abreviatura').val(data.data.abreviatura);
                $('#descripcion').val(data.data.descripcion);
                $('#tipo_empleado').val(data.data.tipo_empleado);
            }
            $(".loader").addClass("hidden");
            $("#cargoModalForm").removeClass("hidden");
        });
        $("#modalCargo").modal();
    }   
</script>