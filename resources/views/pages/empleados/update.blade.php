<script type='text/javascript'>
    function empleadoUpdate(url) {  
        document.getElementById('empleadoForm').reset(); 
        $(".loader").removeClass("hidden");
        $("#empleadoModalForm").addClass("hidden");
        $('#empleadoForm').attr('action',url);
        $("#empleadoLabel").html('Editar Empleado');
        $("#btn-action").html('Actualizar');
        $("#btn-action").addClass('btn-success');
        $("#btn-action").removeClass('btn-primary');        
        $('[name=_method]').val('PUT');

        $('#nombres').attr('required',true);
        $('#apellidos').attr('required',true);
        $('#cedula').attr('required',true);
        $('#fecha_ingreso').attr('required',true);
        $('#horas_semanales').attr('required',true);
        $('#tipo_personal').attr('required',true);
        $('#cargo').attr('required',true);
        $('#prestaciones_sociales_acumuladas').attr('required',true);

        $.get(url,function(data,status){
            data=JSON.parse(data);
            if(data.result) {
                $('#nombres').val(data.data.nombres);
                $('#apellidos').val(data.data.apellidos);
                $('#cedula').val(data.data.cedula);
                $('#fecha_ingreso').datepicker({dateFormat: 'dd/mm/yy', autoclose:true, todayHighlight:true});
                $('#fecha_ingreso').val(moment(data.data.fecha_ingreso, 'YYYY-MM-DD').format('DD/MM/YYYY'));
                $('#horas_semanales').val(data.data.horas_semanales);
                data.data.sso == 1 ? $('#sso').prop('checked', true) : $('#sso').prop('checked', false);
                data.data.lph == 1 ? $('#lph').prop('checked', true) : $('#lph').prop('checked', false);
                $('#tipo_personal').val(data.data.tipo_personal);
                $('#prestaciones_sociales_acumuladas').val(data.data.prestaciones_sociales_acumuladas);
                $("input[name='tiempo_completo'][value='"+data.data.tiempo_completo+"']").prop('checked', true);
                $('#cargo').val(data.data.cargo_id);
                tipoEmpleado(data.data.cargo_id);
                if (data.tipo_empleado == 'Docente') {
                    $('#titulo_docente').val(data.data.docente.titulo_docente);
                    data.data.docente.postgrado == 1 ? $('#postgrado').prop('checked', true) : $('#postgrado').prop('checked', false);
                    data.data.docente.especializacion == 1 ? $('#especializacion').prop('checked', true) : $('#especializacion').prop('checked', false);
                } else {                    
                    if (data.tipo_empleado == 'Obrero') {
                        $('#nivel_instruccion').val(data.data.obrero.nivel_instruccion);
                        $('#clasificacion_obrera').val(data.data.obrero.clasificacion_obrero_id);
                    } else {
                        $('#nivel_instruccion').val(data.data.administrativo.nivel_instruccion);
                        $('#clasificacion_administrativa').val(data.data.administrativo.clasificacion_administrativo_id);
                    }
                }             
            }
            $(".loader").addClass("hidden");
            $("#empleadoModalForm").removeClass("hidden");
        });
        $("#modalEmpleado").modal();
    }
</script>