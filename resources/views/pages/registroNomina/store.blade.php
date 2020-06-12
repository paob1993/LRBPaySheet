<script type='text/javascript'>
   function registroNominaStore(url, recibo_id) {  
       document.getElementById('registroNominaForm').reset(); 
       $('#registroNominaForm').attr('action',url);
       $("#registroNominaLabel").html('Nuevo Registro Nómina');
       $("#btn-action").html('Agregar');
       $("#btn-action").addClass('btn-primary');

       if (recibo_id > 0) {
        $('#recibo_id').val(recibo_id);
       }
   
       $('#nombre').attr('required',true);
       $('#cantidad').attr('required',true);
       $('#tipo_valor').attr('required',true);
       $('#codigo_nomina').attr('required', true);
       $('#tipo_nomina').attr('required', true);
       $('#basado_en').attr('required', true);
       $('#determinado').attr('required', true);
       $('#alertaDeCodigo').css('display', 'none');
       $('#tipo-manual').css('display', 'none');
       var tipos = <?php echo '["' . implode('", "', \App\OwnModels\OwnArrays::$requiere_prima_value) . '"]' ?>;
       var tiposEmpleados = <?php echo '["' . implode('", "', \App\OwnModels\OwnArrays::$tipos_empleados_value) . '"]' ?>;
       for (var i = 0 ; i < tipos.length; i++) {
         $('#requiere-'+tipos[i]).css('display', 'none');
         for (var j = 0 ; j < tiposEmpleados.length; j++) {
          $('#cantidad_'+tiposEmpleados[j]+'_'+tipos[i]).prop('disabled', true);
          $('#cantidad_'+tiposEmpleados[j]+'_'+tipos[i]).val(0);
         }
       }   
       $(".loader").addClass("hidden");
       $("#registroNominaModalForm").removeClass("hidden");
       $("#modalRegistroNomina").modal();
   }

    function verificarCodigo(cod) {
      $("#btn-action").prop('disabled', true);
      $.get('{{url('registroNominas/verificar')}}'+'/'+cod,function(data,status){
        data=JSON.parse(data);
        if(data.result){
          $('#alertaDeCodigo').css('display', 'block');
        } else {
          $('#alertaDeCodigo').css('display', 'none');
          $("#btn-action").prop('disabled', false);
        }
      });
    }

    function toogleDisabled(tipoEmpleado, tipo) {
      var aux = $('#cantidad_'+tipoEmpleado+'_'+tipo).prop('disabled');
      $('#cantidad_'+tipoEmpleado+'_'+tipo).val(0);
      $('#cantidad_'+tipoEmpleado+'_'+tipo).prop('disabled', !aux);
    }

    function toogleVisible(tipo) {
      if ($('#requiere-'+tipo).css('display') == 'none') {
        $('#requiere-'+tipo).css('display', 'block')
      } else {
        $('#requiere-'+tipo).css('display', 'none')
      }
    }

    function tipoCalculo(tipo) {
      $('#codigo_nomina').css('pointer-events', 'auto');
      if (tipo == 2) {
        $('#none').prop('checked', true);
        toogleVisible('none');
        toogleDisabled('adm','none');
        $('#adm-none').prop('checked', true);        
        toogleDisabled('obr','none');
        $('#obr-none').prop('checked', true); 
        toogleDisabled('doc','none');
        $('#doc-none').prop('checked', true); 
      }
      if (tipo == 3) {
        $('#codigo_nomina').css('pointer-events', 'none');
      }
    }

</script>
<div class="modal fade" id="modalRegistroNomina" tabindex="-1" role="dialog" aria-labelledby="modalRegistroNomina" aria-hidden="true">
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
                  <input type="hidden" name="recibo_id" id="recibo_id">

                  <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                     <label for="nombre">Nombre</label>
                     <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" maxlength="{{\App\Models\RegistroNomina::MAX_LENGTH_NOMBRE}}" value="{{old('nombre')}}"/>
                  </div>

                  <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                     <label>Código Nómina</label>
                     <input type="text" class="form-control" id="codigo_nomina" name="codigo_nomina" placeholder="Código Nómina" value="{{old('codigo_nomina')}}" onChange="verificarCodigo(this.value)"/> 
                        <div class="error-message" id="alertaDeCodigo">
                            <div class="alert-with-icon" data-notify="container" >
                                <span data-notify="icon" class="fa fa-exclamation-circle"></span>
                                <span  data-notify="message">Código existente</span>
                            </div>
                        </div>                        
                  </div>

                   <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                     <label for="tipo_valor">Tipo Valor</label>
                  <select class="form-control dropdown" name="tipo_valor" id="tipo_valor">
                    <option value="">Selecciona</option>    
                     @foreach(\App\OwnModels\OwnArrays::$tipos_valor as $key => $value)
                     <option value="{{$key}}">{{$value}}</option>
                     @endforeach
                  </select>
                  </div>                 

                  <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                     <label for="tipo_nomina">Tipo Nómina</label>
                  <select class="form-control dropdown" name="tipo_nomina" id="tipo_nomina">
                     <option value="">Selecciona</option>                        
                     @foreach(\App\OwnModels\OwnArrays::$tipos_nominas as $key => $value)
                     <option value="{{$key}}">{{$value}}</option>
                     @endforeach
                  </select>   
                  </div>    

                  <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                     <label for="basado_en">Basado En</label>
                  <select class="form-control dropdown" name="basado_en" id="basado_en">
                     <option value="">Selecciona</option>                        
                     @foreach(\App\OwnModels\OwnArrays::$basados_en as $key => $value)
                     <option value="{{$key}}">{{$value}}</option>
                     @endforeach
                  </select> 
                  </div> 

                  <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                     <label for="determinado">Tipo de Cálculo</label>
                  <select class="form-control dropdown" name="determinado" id="determinado" onchange="tipoCalculo(value)">
                     <option value="">Selecciona</option>                        
                     @foreach(\App\OwnModels\OwnArrays::$tipos_registros_nomina as $key => $value)
                     <option value="{{$key}}">{{$value}}</option>
                     @endforeach
                  </select> 
                  </div>  

                  <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                    <label for="carga_horaria">¿Debe ser prorrateado por carga horaria?</label>
                    <br>
                    <input class="form-check-input" type="radio" value="1" name="carga_horaria"><span class="form-check-sign"> Sí</span>
                    <br>
                    <input class="form-check-input" type="radio" value="0" name="carga_horaria" checked="true"><span class="form-check-sign"> No</span>
                  </div> 
                    
                    <div class="col-lg-8 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                       <label for="basado_en">Toma en Cuenta</label> <br>                     
                       <input type="checkbox" id="none" name="none" value="none" onclick="toogleVisible(value)"> Único
                       <input type="checkbox" id="lcdo" name="lcdo" value="lcdo" onclick="toogleVisible(value)"> Licenciado
                       <input type="checkbox" id="tsu" name="tsu" value="tsu" onclick="toogleVisible(value)"> T.S.U <br>
                       <input type="checkbox" id="esp" name="esp" value="esp" onclick="toogleVisible(value)"> Especialización
                       <input type="checkbox" id="post" name="post" value="post" onclick="toogleVisible(value)"> Postgrado
                     </div>

                      @foreach(\App\OwnModels\OwnArrays::$requiere_prima_value as $key => $value)
                      <div id="requiere-{{$value}}">
                      @foreach(\App\OwnModels\OwnArrays::$tipos_empleados_value as $keyTE => $valueTE)
                       <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                          <label> <input type="checkbox" id="{{$valueTE}}-{{$value}}" name="{{$valueTE}}-{{$value}}" value="{{$valueTE}}-{{$value}}" onclick="toogleDisabled('{{$valueTE}}', '{{$value}}')"> Valor {{\App\OwnModels\OwnArrays::$tipos_empleados[$keyTE]}} ({{\App\OwnModels\OwnArrays::$requiere_prima[$key]}}):<br></label>
                          <input type="number" class="form-control" id="cantidad_{{$valueTE}}_{{$value}}" name="cantidad_{{$valueTE}}_{{$value}}" step="0.001"/>
                        </div>
                        @endforeach
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