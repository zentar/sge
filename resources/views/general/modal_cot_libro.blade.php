{{--MODAL AGREGAR COTIZACION A LIBRO--}}
   <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal_cot_libro"  name="modal_cot_libro">
   <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" 
          data-dismiss="modal" 
          aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Agregar Cotización</h4>
      </div>

      <div class="modal-body">
      {!!Form::open(['route'=>'image.crear_cotizacion', 'method'=>'POST','files'=>'true', 'id'=>"crear_libro_cotizacion",'name'=>"crear_libro_cotizacion"])!!}

        @if ($errors->count() > 0 and Session::get('error_code') == 7)
                          @include('general/errors')
                    @endif   

       <div class="box box-primary">
                <div class="box-body">

             <div class="col-md-12">
                   <div class="form-group">
                     {{ Form::hidden('libro_id', $libro->id) }}
                     </div></div>
            <div class="col-md-12">
        
             <div class='form-group col-md-12'>
                  <label>Imprenta:</label>
              <input class='form-control' id='imprenta' placeholder='Imprenta' maxlength='200' name='imprenta' type='text' value=''>
            </div>

            <div class='form-group col-md-12'>
                 <label>Tiraje:</label>
              <input class='form-control' id='tiraje' placeholder='Tiraje' maxlength='200' name='tiraje' type='text' value=''>
            </div>

             <div class='form-group col-md-12'>
                  <label>Valor:</label>
              <input class='form-control' id='valor' placeholder='Valor' maxlength='200' name='valor' type='text' value=''>
             </div>

             <div class="form-group col-md-12"> 
                  <label>Seleccione documento de Cotización:</label>                    
             <input type="file" id="documento" name="documento">
             </div>
             </div>

           </div>

           <div class="modal-footer">
      
           <span class="pull-right">
           <button type="submit" class="btn btn-primary">Grabar</button>    
           <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
               
              {!!Form::close()!!}
        </span>
      </div>
    </div>
   </div>    
</div></div></div>