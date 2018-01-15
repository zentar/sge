{{--MODAL APROBAR COTIZACION A LIBRO--}}
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal_aprob_cot_libro"  name="modal_aprob_cot_libro">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" 
               data-dismiss="modal" 
               aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Aprobar Cotización</h4>
         </div>
         <div class="modal-body">
            {!!Form::open(['route'=>'image.crear_cotizacion_aprobado','method'=>'POST','files'=>'true', 'id'=>"crear_libro_cotizacion_aprobado",'name'=>"crear_libro_cotizacion_aprobado"])!!}
            {{ Form::hidden('libro_id', $libro->id) }}

            @if ($errors->count() > 0 and Session::get('error_code') == 8)
            @include('general/errors')
            @endif   
            
            <div class="box box-primary">
               <div class="box-body">
                  <div class="form-group col-md-12">
                     <label>Seleccione la cotización aprobada*:</label> 
                     <select id="aprobado_id" style="width: 100%" class="form-control" name="aprobado_id">
                        <option value=null> Seleccionar Cotizacion </option>
                        @foreach($libro->cotizacion as $file)
                        <option value="{{ $file->id }}">{{$loop->index+1}} - {{$file->imprenta}} - {{$file->tiraje}} - {{$file->valor}} </option>
                        @endforeach
                     </select>
                  </div>
                  <div class="form-group col-md-12">  
                     <label>Seleccione el archivo correspondiente*:</label>                      
                     <input type="file" id="documento" name="documento">
                  </div>
               </div>
               <div class="modal-footer">
                  <span class="pull-right">
                  <button type="submit" class="btn btn-primary">Aprobar</button>    
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                  {!!Form::close()!!}
                  </span>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>