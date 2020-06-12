<script type='text/javascript'>
    function clasificacionAdministrativoUpdateAll(url) { 
        document.getElementById('ClasificacionAdministrativoUpdateAllForm').reset(); 
        $(".loader").removeClass("hidden");
        $("#ClasificacionAdministrativoUpdateAllModalForm").addClass("hidden");
        $('[name=_method]').val('POST');
        $("#ClasificacionAdministrativoUpdateAllLabel").html('Editar montos');
        $('#ClasificacionAdministrativoUpdateAllForm').attr('action',url);
        var clasificacion_administrativo = <?php echo json_encode($clasificacion_administrativo) ?>;  
        for (var i = clasificacion_administrativo.length - 1; i >= 0; i--) {
            $('#monto-'+clasificacion_administrativo[i].nivel+'-'+clasificacion_administrativo[i].grado).val(clasificacion_administrativo[i].monto);
        }

        $(".loader").addClass("hidden");
        $("#ClasificacionAdministrativoUpdateAllModalForm").removeClass("hidden");

        $("#ClasificacionAdministrativoUpdateAllModal").modal();
    }   
</script>

<div class="modal fade" id="ClasificacionAdministrativoUpdateAllModal" tabindex="-1" role="dialog" aria-labelledby="ClasificacionAdministrativoUpdateAllModal" aria-hidden="true">
    <div class="modal-dialog modal-big">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title" id="ClasificacionAdministrativoUpdateAllLabel"></h3>
            </div>
            
            <div class="modal-body no-border">
                <div class="col-xs-12">
                    <h4 id="div-inner-title"></h4>
                </div>
                <div class="loader text-center">
                    <i class="fas fa-spinner fa-spin fa-3x fa-fw"></i>
                    <span class="sr-only">Loading...</span>
                </div>

                <div class="col-xs-12" id="ClasificacionAdministrativoUpdateAllModalForm">
                    <form class="form-horizontal" id="ClasificacionAdministrativoUpdateAllForm" method='POST'>
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="POST">

                        <div class="table-responsive table-full-width">

                            <table class="table table-hover table-striped table-center">
                                <thead>
                                    <tr>
                                        <th>Nivel </th>
                                        @foreach($clasf_grados as $grado)
                                            <th>Grado {{$grado->grado}}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach($clasf_nivel as $nivel)                               
                                        <tr>
                                            <th>{{$nivel->nivel}}</th>
                                            @foreach($clasf_grados as $grado)
                                                <td> <input type="number" class="form-control" name="monto-{{$nivel->nivel}}-{{$grado->grado}}" id="monto-{{$nivel->nivel}}-{{$grado->grado}}" step="0.01"></td>
                                            @endforeach
                                        </tr> 
                                    @endforeach
                                </tbody>
                            </table>

                        </div>

                            
                        <div class="col-xs-12 text-center margin-top modal-footer">
                            <button type="submit" class="btn btn-success" id="btn-action">Actualizar</button>
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