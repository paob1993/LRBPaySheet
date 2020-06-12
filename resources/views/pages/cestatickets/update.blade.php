<script type='text/javascript'>
   function cestaticketUpdate(url, cestaticket_id) { 
       document.getElementById('cestaticketForm').reset(); 
       $(".loader").addClass("hidden");
       $("#cestaticketModalForm").removeClass("hidden");
       $('[name=_method]').val('PUT');
       $("#cestaticketLabel").html('Descontar Horas');
       $('#cestaticketForm').attr('action',url);
       $('#btn-action').html('Descontar');
       $('#btn-action').addClass('btn-warning');
       $('#btn-action').removeClass('btn-primary');
       $('#recibo_cestaticket_id').val(cestaticket_id);
       $("#modalCestaticket").modal();
   } 
</script>
<div class="modal fade" id="modalCestaticket" tabindex="-1" role="dialog" aria-labelledby="modalCestaticket" aria-hidden="true">
   <div class="modal-dialog modal-big">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3 class="modal-title" id="cestaticketLabel"></h3>
         </div>
         <div class="modal-body no-border">
            <div class="col-xs-12">
               <h4 id="div-inner-title"></h4>
            </div>
            <div class="loader text-center">
               <i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>
               <span class="sr-only">Loading...</span>
            </div>
            <div class="col-xs-12" id="cestaticketModalForm">
               <form class="form-horizontal" id="cestaticketForm" method='POST'>
                  {!! csrf_field() !!}
                  <input type="hidden" name="_method" value="POST">
                  <input type="hidden" name="recibo_cestaticket_id" id="recibo_cestaticket_id" >
                  <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                     <label for="faltas">Faltas: (Horas)</label>
                     <input type="number" min="0.01" step="0.01" class="form-control" id="faltas" name="faltas" placeholder="faltas" value="{{old('faltas')}}" required="true" />
                  </div>
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