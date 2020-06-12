<script type='text/javascript'>
   function cargoStore(url) {  
       document.getElementById('cargoForm').reset(); 
       $('#cargoForm').attr('action',url);
       $("#cargoLabel").html('Nuevo Cargo');
       $("#btn-action").html('Agregar');
       $("#btn-action").addClass('btn-primary');
   
       $('#abreviatura').attr('required',true);
       $('#descripcion').attr('required',true);
       $('#tipo_empleado').attr('required',true);
   
       $(".loader").addClass("hidden");
       $("#cargoModalForm").removeClass("hidden");
       $("#modalCargo").modal();
   }
</script>
<div class="modal fade" id="modalCargo" tabindex="-1" role="dialog" aria-labelledby="modalCargo" aria-hidden="true">
   <div class="modal-dialog modal-big">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3 class="modal-title" id="cargoLabel"></h3>
         </div>
         <div class="modal-body no-border">
            <div class="col-xs-12">
               <h4 id="div-inner-title"></h4>
            </div>
            <div class="loader text-center">
               <i class="fas fa-spinner fa-spin fa-3x fa-fw"></i>
               <span class="sr-only">Loading...</span>
            </div>
            <div class="col-xs-12" id="cargoModalForm">
               <form class="form-horizontal" id="cargoForm" method='POST'>
                  {!! csrf_field() !!}
                  <input type="hidden" name="_method" value="POST">
                  <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                     <label for="abreviatura">Abreviatura</label>
                     <input type="text" class="form-control" id="abreviatura" name="abreviatura" placeholder="Abreviatura" maxlength="{{\App\Models\Cargo::MAX_LENGTH_ABREVIATURA}}" value="{{old('abreviatura')}}"/>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                     <label for="descripcion">Descripción</label>
                     <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripción" maxlength="{{\App\Models\Cargo::MAX_LENGTH_DESCRIPCION}}" value="{{old('descripcion')}}"/>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                     <label for="tipo_empleado">Tipo de Empleado:</label>
                     <select class="form-control" name="tipo_empleado" id="tipo_empleado">
                        <option value="0" selected>Selecciona</option>
                        @foreach(\App\OwnModels\OwnArrays::$tipos_empleados as $key => $value)
                        @if($key == old('tipo_empleado'))
                        <option value="{{$key}}" selected>{{$value}}</option>
                        @else
                        <option value="{{$key}}">{{$value}}</option>
                        @endif
                        @endforeach
                     </select>
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