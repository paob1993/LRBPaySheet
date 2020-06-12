<script type='text/javascript'>
    function reciboPrestacionesShow(url, export_url) {
        var niveles_instruccion = new Object();
        var basados_en = new Object(); 
        var titulos_docentes = new Object();  
        <?php foreach($niveles_instruccion as $key=>$value) {  ?>
            niveles_instruccion["<?php echo $key; ?>"] = "<?php echo $value; ?>";
        <?php }?> 
        <?php foreach($titulos_docentes as $key=>$value) {  ?>
            titulos_docentes["<?php echo $key; ?>"] = "<?php echo $value; ?>";
        <?php }?>
        <?php foreach($basados_en as $key=>$value) {  ?>
            basados_en["<?php echo $key; ?>"] = "<?php echo $value; ?>";
        <?php }?>                
        $(".loader").removeClass("hidden");
        $("#reciboModal").addClass("hidden");
        $('#reciboForm').attr('href',export_url);
        $("#btn-action").html('Descargar');
        $("#btn-action").addClass('btn-success');
        $("#btn-action").removeClass('btn-primary');      
        $.get(url,function(data,status){
            data=JSON.parse(data);
            if(data.result) {                
                $('#reciboLabel').text('Prestaciones Sociales: ' + data.data.recibo_prestaciones_sociales.trimestre + 'º trimestre del ' + data.data.recibo_prestaciones_sociales.ano); 
                $('#nombres').text(data.data.empleado.nombres + ' ' + data.data.empleado.apellidos);
                $('#cedula').text(data.data.empleado.cedula);
                $('#fecha-ingreso').text(moment(data.data.empleado.fecha_ingreso, 'YYYY-MM-DD').format('DD/MM/YYYY'));
                $('#antiguedad').text(moment().diff(moment(data.data.empleado.fecha_ingreso, 'YYYY-MM-DD'), 'years') + ' años y ' + (moment().diff(moment(data.data.empleado.fecha_ingreso, 'YYYY-MM-DD'), 'months')%12) + ' meses');
                $('#cargo').text(data.data.empleado.cargo.descripcion);
                $('#horas-semanales').text(data.data.empleado.horas_semanales + ' horas');
                if (data.data.empleado.administrativo) {
                    $('#datos-otro').css('display', 'block');
                    $('#datos-docente').css('display', 'none');
                    $('#nivel-instruccion-otro').text(niveles_instruccion[data.data.empleado.administrativo.nivel_instruccion]);
                    $('#clasificacion-otro').text(data.data.empleado.administrativo.clasificacion_administrativo.grado + '-' +data.data.empleado.administrativo.clasificacion_administrativo.nivel);
                    $('#valor-hora-otro').text(data.data.empleado.administrativo.clasificacion_administrativo.monto + ' Bs.');
                } else if (data.data.empleado.obrero) {
                    $('#datos-otro').css('display', 'block');
                    $('#datos-docente').css('display', 'none');
                    $('#nivel-instruccion-otro').text(niveles_instruccion[data.data.empleado.obrero.nivel_instruccion])
                    $('#clasificacion-otro').text(data.data.empleado.obrero.clasificacion_obrero.grado + '-' +data.data.empleado.obrero.clasificacion_obrero.paso);
                    $('#valor-hora-otro').text(data.data.empleado.obrero.clasificacion_obrero.monto + ' Bs.');                    
                } else if (data.data.empleado.docente) {
                    $('#datos-otro').css('display', 'none');
                    $('#datos-docente').css('display', 'block');
                    $('#titulo-docente').text(titulos_docentes[data.data.empleado.docente.titulo_docente]);
                    $('#categoria-docente').text(data.data.empleado.docente.categoria_docente.categoria);
                    $('#valor-hora').text(data.data.empleado.docente.categoria_docente.valor_hora + ' Bs.');
                }
                $('#monto-depositado').text(data.data.monto + 'Bs.');
                $('#monto-acumulado').text(data.data.empleado.prestaciones_sociales_acumuladas + 'Bs.');
            }
            $(".loader").addClass("hidden");
            $("#reciboModal").removeClass("hidden");
        }); 
        $("#modalRecibo").modal();      
    }
</script>

<div class="modal fade" id="modalRecibo" tabindex="-1" role="dialog" aria-labelledby="modalRecibo" aria-hidden="true">
    <div class="modal-dialog modal-big">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title" id="reciboLabel"></h3>
            </div>
            
            <div class="modal-body no-border">
                <div class="col-xs-12">
                    <h4 id="div-inner-title"></h4>
                </div>
                <div class="loader text-center">
                    <i class="fas fa-spinner fa-spin fa-3x fa-fw"></i>
                    <span class="sr-only">Loading...</span>
                </div>

                <div class="col-xs-12" id="reciboModal">

                    <div class="row" id="datos-empleado">
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <label class="invoice" for="nombres">Nombres y Apellidos: <span class="invoice-span" id="nombres"></span></label>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <label class="invoice" for="cedula">Cédula de Identidad: <span class="invoice-span" id="cedula"></span></label>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <label class="invoice" for="fecha-ingreso">Fecha de Ingreso: <span class="invoice-span" id="fecha-ingreso"></span></label>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <label class="invoice" for="antiguedad">Antiguedad: <span class="invoice-span" id="antiguedad"></span></label>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <label class="invoice" for="cargo">Cargo: <span class="invoice-span" id="cargo"></span></label>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <label class="invoice" for="horas-semanales">Horas Semanales: <span class="invoice-span" id="horas-semanales"></span></label>
                        </div>
                    </div>

                    <div class="row" id="datos-docente">
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <label class="invoice" for="titulo-docente">Título Docente: <span class="invoice-span" id="titulo-docente"></span></label>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <label class="invoice" for="categoria-docente">Categoría Docente: <span class="invoice-span" id="categoria-docente"></span></label>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <label class="invoice" for="valor-hora">Valor por hora: <span class="invoice-span" id="valor-hora"></span></label>
                        </div>
                    </div>

                    <div class="row" id="datos-otro">
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <label class="invoice" for="nivel-instruccion-otro">Nivel de Instrucción: <span class="invoice-span" id="nivel-instruccion-otro"></span></label>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <label class="invoice" for="clasificacion-otro">Clasificación: <span class="invoice-span" id="clasificacion-otro"></span></label>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <label class="invoice" for="valor-hora-otro">Valor por hora: <span class="invoice-span" id="valor-hora-otro"></span></label>
                        </div>
                    </div>

                    <div class="row" id="datos-prestaciones">
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <label class="invoice" for="nivel-instruccion-otro">Monto Depositado: <span class="invoice-span" id="monto-depositado"></span></label>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <label class="invoice" for="clasificacion-otro">Monto Acumulado: <span class="invoice-span" id="monto-acumulado"></span></label>
                        </div>
                    </div>
                        

                    <div class="col-xs-12 text-center margin-top modal-footer">
                        <a id="reciboForm">
                            <button type="button" class="btn" id="btn-action"></button>
                        </a>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
                
                <div class="col-xs-12 div-center" id="divModalStoreResp"></div>
            </div>

            <div class="modal-footer no-border"></div>
        </div>
    </div>
</div>