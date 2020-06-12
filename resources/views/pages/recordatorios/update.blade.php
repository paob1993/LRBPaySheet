<script type='text/javascript'>
    function recordatorioUpdate(url) {  
        document.getElementById('recordatorioForm').reset(); 
        $(".loader").removeClass("hidden");
        $("#recordatorioModalForm").addClass("hidden");
        $('#recordatorioForm').attr('action',url);
        $("#recordatorioLabel").html('Editar Recordatorio');
        $("#btn-action").html('Actualizar');
        $("#btn-action").addClass('btn-success');
        $("#btn-action").removeClass('btn-primary');        
        $('[name=_method]').val('PUT');

        $.get(url,function(data,status){
            data=JSON.parse(data);
            if(data.result) {
                $("#empleado").val(data.data.empleado_id);
                $("#nota").val(data.data.nota);
                $('#fecha').datepicker({dateFormat: 'dd/mm/yy', autoclose:true, todayHighlight:true});
                $('#fecha').val(moment(data.data.fecha, 'YYYY-MM-DD').format('DD/MM/YYYY'));  
            }
            $(".loader").addClass("hidden");
            $("#recordatorioModalForm").removeClass("hidden");
        });
        $("#modalRecordatorio").modal();
    }
</script>