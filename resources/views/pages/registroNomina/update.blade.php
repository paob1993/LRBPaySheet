<script type='text/javascript'>
  function registroNominaUpdate(url, recibo_id) { 
    document.getElementById('registroNominaForm').reset(); 
      $(".loader").removeClass("hidden");
      $("#registroNominaModalForm").addClass("hidden");
      $('[name=_method]').val('PUT');
      $('#registroNominaForm').attr('action',url);
      $("#registroNominaLabel").html('Editar Registro Nómina');
      $("#btn-action").html('Actualizar');
      $("#btn-action").addClass('btn-primary');

      if (recibo_id > 0) {
        $('#recibo_id').val(recibo_id);
      }
      var tipos = <?php echo '["' . implode('", "', \App\OwnModels\OwnArrays::$requiere_prima_value) . '"]' ?>;
      var tiposEmpleados = <?php echo '["' . implode('", "', \App\OwnModels\OwnArrays::$tipos_empleados_value) . '"]' ?>;
      for (var i = 0 ; i < tipos.length; i++) {
        $('#requiere-'+tipos[i]).css('display', 'none');
        for (var j = 0 ; j < tiposEmpleados.length; j++) {
          $('#cantidad_'+tiposEmpleados[j]+'_'+tipos[i]).prop('disabled', true);
          $('#cantidad_'+tiposEmpleados[j]+'_'+tipos[i]).val(0);
      }
    }

    $.get(url,function(data,status){
      data=JSON.parse(data);
      var tipos = <?php echo '["' . implode('", "', \App\OwnModels\OwnArrays::$requiere_prima_value) . '"]' ?>;
      var tiposEmpleados = <?php echo '["' . implode('", "', \App\OwnModels\OwnArrays::$tipos_empleados_value) . '"]' ?>;
      if(data.result) {
        $('#nombre').val(data.data.nombre);              
        $('#tipo_valor').val(data.data.tipo_valor);
        $('#codigo_nomina').val(data.data.codigo_nomina);  
        $('#tipo_nomina').val(data.data.tipo_nomina);    
        $('#basado_en').val(data.data.basado_en);     
        $('#determinado').val(data.data.determinado); 
        $("input[name='carga_horaria'][value='"+data.data.carga_horaria+"']").prop('checked', true);
        tipoCalculo(data.data.determinado);
        for (var i = data.data.registro_nomina_tipos_empleado.length - 1; i >= 0; i--) {
          if ($('#requiere-'+tipos[data.data.registro_nomina_tipos_empleado[i].depende_de - 1]).css('display') == 'none') {
            $('#'+tipos[data.data.registro_nomina_tipos_empleado[i].depende_de - 1]).prop('checked', true);
            toogleVisible(tipos[data.data.registro_nomina_tipos_empleado[i].depende_de - 1]);
          }
          $('#'+tiposEmpleados[data.data.registro_nomina_tipos_empleado[i].tipo_empleado - 1]+'-'+tipos[data.data.registro_nomina_tipos_empleado[i].depende_de - 1]).prop('checked', true);
          if (data.data.determinado != 2) {
            toogleDisabled(tiposEmpleados[data.data.registro_nomina_tipos_empleado[i].tipo_empleado - 1],tipos[data.data.registro_nomina_tipos_empleado[i].depende_de - 1]);
          }
          $('#cantidad_'+tiposEmpleados[data.data.registro_nomina_tipos_empleado[i].tipo_empleado - 1]+'_'+tipos[data.data.registro_nomina_tipos_empleado[i].depende_de - 1]).val(data.data.registro_nomina_tipos_empleado[i].cantidad);
        }                        
      }
      $('#alertaDeCodigo').css('display', 'none');
      $("#btn-action").prop('disabled', false);
      $ (".loader").addClass("hidden");
      $("#registroNominaModalForm").removeClass("hidden");
    });
    $("#modalRegistroNomina").modal();
  }
</script>