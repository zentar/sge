   {{--MODAL MOSTRAR DOCUMENTO--}}
   <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="tipo_papel_modal_crear" name="tipo_papel_modal_crear">
   <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" 
          data-dismiss="modal" 
          aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="doc_modal_title"><strong>Categoria:</strong> tipo de papel</h4>
      </div>

      <div class="modal-body" >
          {!!Form::open(['route'=>'caracteristicas.createtipo','method'=>'POST', 'id'=>"create_caracteristica_tipo_papel",'name'=>"create_caracteristica_tipo_papel"])!!}
            {{ Form::hidden('tipo', 'tipo_papel') }}
            @if ($errors->count() > 0 and Session::get('error_code') == 10)
            @include('general/errors')
            @endif   
            
            <div class="box box-primary">
               <div class="box-body">
                  <div class="form-group col-md-12">
                        <label>Descripción*:</label> 
                       {!!Form::text('descripcion_tipo',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100','id'=>'descripcion_tipo'])!!}                     
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
   </div>    
</div>
</div>