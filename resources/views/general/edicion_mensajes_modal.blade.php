{{--MODAL AGREGAR DOCUMENTO A LIBRO--}}
<div class="modal fade bd-example-modal-lg" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="edicion_mensajes_modal"  name="edicion_mensajes_modal">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"  aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="favoritesModalLabel"><strong>Nuevo Mensaje</strong></h4>
         </div>
         <div class="modal-body">
            <div class="box box-primary">
               <div class="box-body">
                  {!!Form::open(['route'=>'libro.crear_mensaje', 'method'=>'POST','files'=>'true', 'id'=>"crear_libro_mensaje",'name'=>"crear_libro_mensaje"])!!}

                  @if ($errors->count() > 0 and Session::get('error_code') == 9)
                  @include('general/errors')
                  @endif       

                  <div class="col-md-12">
                     <div class="form-group"> 
                        {{ Form::hidden('libro_id', $libro->id) }}    
                     </div>
                  </div>
                  <div class="col-md-12">

                     <div class="form-group col-md-12">                     
                        <label>Mensaje*:</label> 
                         {!!Form::textarea('mensaje',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'500',"style"=>"overflow:auto;overflow-y:scroll;resize:none","rows"=>"3", "cols"=>"30"])!!} 
                     </div>

                     <div class="form-group col-md-12"> 
                        <label>Cargar Archivo:</label>                    
                        {!!Form::File('archivo_imagen')!!}
                     </div>
            
                  </div>
               </div>
               <!-- /.box-body -->
            </div>
            <!-- /.box -->
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <span class="pull-right">
            <button type="submit" class="btn btn-primary">Enviar</button>        
            {!!Form::close()!!}
            </span>
         </div>
      </div>
   </div>
</div>