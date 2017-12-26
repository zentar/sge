   {{--MODAL AGREGAR AUTOR--}}
   <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal_documento">
   <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" 
          data-dismiss="modal" 
          aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="favoritesModalLabel">Imagen</h4>
      </div>

      <div class="modal-body">
           <div class="box box-primary">
                <div class="box-body" id="documento_body">               
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