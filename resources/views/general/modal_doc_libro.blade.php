 {{--MODAL AGREGAR DOCUMENTO A LIBRO--}}
   <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal_doc_libro"  name="modal_doc_libro">
   <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" 
          data-dismiss="modal" 
          aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="favoritesModalLabel">Agregar Documento libro</h4>
      </div>

      <div class="modal-body">
           <div class="box box-primary">
                <div class="box-body">
    
               {!!Form::open(['route'=>'image.crear_libro', 'method'=>'POST','files'=>'true', 'id'=>"crear_libro_documentos",'name'=>"crear_libro_documentos"])!!}

                         @if ($errors->count() > 0 and Session::get('error_code') == 6)
                          @include('general/errors')
                    @endif          

             <div class="col-md-12">
                <div class="form-group"> 
                     {{ Form::hidden('libro_id', $libro->id) }}    
             </div></div>

             <div class="col-md-12">
              <div class="form-group col-md-12"> 
              <label>Seleccione el tipo de documento:</label> 
              <div class='form-group col-md-12'><select id='tipo_doc' style='width: 100%' class='form-control select2' name='tipo_doc[]'><option value='null'>Seleccionar Tipo Documento </option>@foreach($tipos_doc_libro as $tipo)<option value='{{ $tipo->id }}'> {{ $tipo->nombre }}</option>@endforeach</select></div>
            </div>

              <div class="form-group col-md-12"> 
              <label>Seleccione el archivo correspondiente:</label>                    
                        {!!Form::File('documento')!!}
                    </div>
                    </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

           </div>
           <div class="modal-footer">
           <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
           <span class="pull-right">
           <button type="submit" class="btn btn-primary">Grabar</button>        
              {!!Form::close()!!}
        </span>
      </div>
    </div>
   </div>    
</div>