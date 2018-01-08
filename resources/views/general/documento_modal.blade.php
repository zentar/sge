   {{--MODAL MOSTRAR DOCUMENTO--}}
   <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal_documento" name="modal_documento">
   <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" 
          data-dismiss="modal" 
          aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="doc_modal_title"></h4>
      </div>

      <div class="modal-body" >
          <div id="doc_modal" name="doc_modal"></div>

        {{-- IMAGENES <img id="imagen_doc" src="{{ route('image.documentos', ['file' => 2]) }}" alt="imagen" style=" display: block;
        margin-left: auto; margin-right: auto; max-height:650px;"></div> --}}

        {{-- PDF <div style="text-align: center;">
        <iframe src="{{ route('image.documentos', ['file' => 1]) }}" 
        style="width:100%; height:500px;" frameborder="0"></iframe>
        </div> --}}


           <div class="modal-footer">
           <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          
        </span>
      </div>
    </div>
   </div>    
</div>