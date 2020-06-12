<script type='text/javascript'>
    function recordatorioStore(url) {  
        document.getElementById('recordatorioForm').reset(); 
        $('#recordatorioForm').attr('action',url);
        $('[name=_method]').val('POST');
        $('#recordatorioLabel').html('Nuevo Recordatorio');
        $('#btn-action').html('Agregar');
        $('#btn-action').addClass('btn-primary');
        $('#btn-action').removeClass('btn-success');
        $('#fecha').datepicker({dateFormat: 'dd/mm/yy', autoclose:true, todayHighlight:true});
        $('#fecha').val('');
        $('.loader').addClass('hidden');
        $('#divModalForm').removeClass('hidden');
        $('#modalRecordatorio').modal();

        $('#nota').attr('required',true);
        $('#empleado').attr('required',true);
        $('#fecha').attr('required',true);
    }
</script>

<div class="modal fade" id="modalRecordatorio" tabindex="-1" role="dialog" aria-labelledby="modalRecordatorio" aria-hidden="true">
    <div class="modal-dialog modal-big">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title" id="recordatorioLabel"></h3>
            </div>
            
            <div class="modal-body no-border">
                <div class="col-xs-12">
                    <h4 id="div-inner-title"></h4>
                </div>
                <div class="loader text-center">
                    <i class="fas fa-spinner fa-spin fa-3x fa-fw"></i>
                    <span class="sr-only">Loading...</span>
                </div>

                <div class="col-xs-12" id="recordatorioModalForm">
                    <form class="form-horizontal" id="recordatorioForm" method='POST'>
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="POST">

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                            <label for="empleado">Empleado</label>
                            <select class="form-control" name="empleado_id" id="empleado">
                                <option value="">Selecciona</option>
                                @foreach($empleados as $key)
                                @if($key->id == old('empleado_id'))
                                <option value="{{$key->id}}" selected>{{$key->nombres}} {{$key->apellidos}}</option>
                                @else
                                <option value="{{$key->id}}">{{$key->nombres}} {{$key->apellidos}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12 margin-top div-fix-height">
                            <label for="nota">Nota</label>
                            <textarea class="form-control" id="nota" name="nota" placeholder="Nota..." value="{{old('nota')}}" maxlength="{{\App\Models\Recordatorios::MAX_LENGTH_NOTA}}" rows="6" ></textarea>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-top div-fix-height">
                            <label for="fecha">Fecha</label>
                            <input class="form-control" id="fecha" name="fecha" value="{{old('fecha')}}" placeholder="Fecha"/>
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