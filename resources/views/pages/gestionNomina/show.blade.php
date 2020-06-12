<script type='text/javascript'>
    function reciboShow(url, export_url) { 
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
        $("#reciboLabel").html('Visualizar Recibo');
        $("#btn-action").html('Descargar');
        $("#btn-action").addClass('btn-success');
        $("#btn-action").removeClass('btn-primary');
        $('#datos-docente').css('display', 'none');
        $('#datos-otro').css('display', 'none');       
        $.get(url,function(data,status){
            data=JSON.parse(data);
            if(data.result) {                
                $('#periodo').text(data.data.recibo.mes + '-' + data.data.recibo.ano); 
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
                if (data.data.registro_nominas_recibo_empleado.length > 0) {
                    var asig = 0, ded = 0, ret = 0;
                    $('#tabla-registros').empty();
                    $('#sin-datos').css('display', 'none');
                    var toAppend = '';
                    for (var i = 0; i < data.data.registro_nominas_recibo_empleado.length; i++) {
                        var reg = data.data.registro_nominas_recibo_empleado[i];
                        if (reg.registro_nomina.basado_en == 1) {
                            toAppend += '<tr class="tabla-recibo">' + 
                                '<td> - </td>' +
                                '<td>' + reg.registro_nomina.codigo_nomina + ' - ' + reg.registro_nomina.nombre + '</td>' + 
                                '<td>' + reg.cantidad + ' Bs.</td>';
                            if (reg.registro_nomina.tipo_nomina === 1) {
                                toAppend +=  '<td>' + reg.monto_total + ' Bs.</td> <td> - </td> <td> - </td>';
                                asig = asig + reg.monto_total;                          
                            } else if (reg.registro_nomina.tipo_nomina === 2) {
                                toAppend += '<td> - </td> <td>' + reg.monto_total + ' Bs.</td> <td> - </td>';
                                ded = ded + reg.monto_total                            
                            } else if (reg.registro_nomina.tipo_nomina === 3) {
                                toAppend += '<td> - </td> <td> - </td> <td>' + reg.monto_total + ' Bs.</td>'; 
                                ret = ret + reg.monto_total                          
                            }
                            toAppend += '<tr>';
                        } else {
                            toAppend += '<tr class="tabla-recibo">' + 
                                '<td>' + reg.cantidad + ' ' +basados_en[reg.registro_nomina.basado_en] + '</td>' +
                                '<td>' + reg.registro_nomina.codigo_nomina + ' - ' + reg.registro_nomina.nombre + '</td>' + 
                                '<td>' + reg.monto_base + ' Bs.</td>';
                            if (reg.registro_nomina.tipo_nomina === 1) {
                                toAppend +=  '<td>' + reg.monto_total + ' Bs.</td> <td> - </td> <td> - </td>';
                                asig = asig + reg.monto_total;                          
                            } else if (reg.registro_nomina.tipo_nomina === 2) {
                                toAppend += '<td> - </td> <td>' + reg.monto_total + ' Bs.</td> <td> - </td>';
                                ded = ded + reg.monto_total                            
                            } else if (reg.registro_nomina.tipo_nomina === 3) {
                                toAppend += '<td> - </td> <td> - </td> <td>' + reg.monto_total + ' Bs.</td>'; 
                                ret = ret + reg.monto_total                          
                            }
                            toAppend += '<tr>';
                        }
                    }
                    toAppend += '<tr> <td> </td> <td> Primera Quincena</td> <td></td> <td></td> <td>' + data.data.primer_quincena + ' Bs.</td> <td> </td> <tr>';
                    ded += data.data.primer_quincena;
                    toAppend += '<tr> <td> </td> <td> </td> <td class="dark-bold"> Total </td> <td class="dark-bold">' + asig.toFixed(2) + ' Bs.</td> <td class="dark-bold">' + ded.toFixed(2) + ' Bs.</td> <td class="dark-bold">' + ret.toFixed(2) + ' Bs.</td> <tr>';
                    $('#tabla-registros').append(toAppend);
                } else {
                    $('#sin-datos').css('display', 'block');
                }
                $('#segunda-quincena').text(data.data.monto_total - data.data.primer_quincena + 'Bs.');
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

                    <div class="row" id="datos-factura">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label class="invoice" for="periodo">Periodo: <span class="invoice-span" id="periodo"></span></label>
                        </div>
                    </div>

                    <div class="row" id="datos-empleado">
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <label class="invoice-1" for="nombres">Nombres y Apellidos: <span class="invoice-span" id="nombres"></span></label>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <label class="invoice-1" for="cedula">Cédula de Identidad: <span class="invoice-span" id="cedula"></span></label>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <label class="invoice-1" for="fecha-ingreso">Fecha de Ingreso: <span class="invoice-span" id="fecha-ingreso"></span></label>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <label class="invoice-1" for="antiguedad">Antiguedad: <span class="invoice-span" id="antiguedad"></span></label>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <label class="invoice-1" for="cargo">Cargo: <span class="invoice-span" id="cargo"></span></label>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <label class="invoice-1" for="horas-semanales">Horas Semanales: <span class="invoice-span" id="horas-semanales"></span></label>
                        </div>
                    </div>

                    <div class="row" id="datos-docente">
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <label class="invoice-1" for="titulo-docente">Título Docente: <span class="invoice-span" id="titulo-docente"></span></label>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <label class="invoice-1" for="categoria-docente">Categoría Docente: <span class="invoice-span" id="categoria-docente"></span></label>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <label class="invoice-1" for="valor-hora">Valor por hora: <span class="invoice-span" id="valor-hora"></span></label>
                        </div>
                    </div>

                    <div class="row" id="datos-otro">
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <label class="invoice-1" for="nivel-instruccion-otro">Nivel de Instrucción: <span class="invoice-span" id="nivel-instruccion-otro"></span></label>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <label class="invoice-1" for="clasificacion-otro">Clasificación: <span class="invoice-span" id="clasificacion-otro"></span></label>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <label class="invoice-1" for="valor-hora-otro">Valor por hora: <span class="invoice-span" id="valor-hora-otro"></span></label>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                   <th>Cantidad</th>
                                   <th>Cod - Descripción</th>
                                   <th>Monto Base</th>
                                   <th>Asignaciones</th>
                                   <th>Deducciones</th>
                                   <th>Retenciones</th>
                               </tr>
                            </thead>
                            <tbody id="tabla-registros">
                                <tr id="sin-datos">
                                    <td colspan='12'>No se han encontrado resultados...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label class="invoice" for="segunda-quincena">Total a pagar en la Segunda Quincena: <span class="invoice-span" id="segunda-quincena"></span></label>
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