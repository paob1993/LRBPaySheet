<script type='text/javascript'>
   function confirmatioGetModal(url) {
       document.getElementById('confirmationModal').reset(); 
       $('#confirmationModal').attr('action',url);
       $('[name=_method]').val('GET');
       $('#aceptar-action').html('Aceptar');
       $('#cancelar-action').html('Cancelar');
       $('#recibo_id').val(id);
       $("#modalConfirmacion").modal();
   }   
</script>
<div class="modal fade" id="modalConfirmacion" tabindex="-1" role="dialog" aria-labelledby="modalConfirmacion" aria-hidden="true">
   <div class="container">
      <div class="row">
         <div class="col-md-2">
         </div>
         <form class='form-horizontal' id="confirmationModal" method='GET'>
            {!! csrf_field() !!}
            <div class="col-md-8">
               <div class="modal-dialog modal-big">
                  <div class="modal-content text-center">
                     <div class="modal-body no-border">
                        <h4 id="div-inner-title">
                           ¿Esta seguro de confirmar esta acción?
                        </h4>
                        <br>
                        <div class="text-center">
                           <button type="submit" class="btn btn-default" id="aceptar-action"></button>
                           <button type="button" id="cancelar-action" class="btn btn-default" data-dismiss="modal"></button>
                        </div>
                        <div class="modal-footer no-border"></div>
                     </div>
                  </div>
               </div>
            </div>
         </form>
         <div class="col-md-2">
         </div>
      </div>
   </div>
</div>