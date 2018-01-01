

                    <div class="form-group col-md-6">                     
                      <label>Cedula</label> 
                       {!!Form::text('cedula',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100'])!!} 
                    </div>
                    <div class="form-group col-md-6">
                      <label>Nombre</label>
                      {!!Form::text('nombre',null,['class'=>'form-control', 
                      'placeholder'=>'-','maxlength'=>'100'])!!}
                    </div>
                    <div class="form-group col-md-6">
                      <label>Apellido</label>
                       {!!Form::text('apellido',null,['class'=>'form-control', 
                      'placeholder'=>'-','maxlength'=>'100'])!!}
                    </div>
                    <div class="form-group col-md-6">
                      <label>Email</label>
                        {!!Form::text('email',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100'])!!}
                    </div>
                    <div class="form-group col-md-6">
                      <label>Teléfono</label>
                        {!!Form::text('telefono',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'10'])!!}
                    </div>
                    <div class="form-group col-md-6">
                      <label>Filiaciones</label>
                        {!!Form::text('filiacion',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100'])!!}
                    </div>         

                    @if($autor->file->count() > 0)  
                    <div class="form-group col-md-12">
                       <label>Documentos</label>{!!link_to_route('autor.editardocumentos', $title = "Editar documentos", $parameters = $autor->id, $attributes = ['class'=>"btn btn-link fa fa-plus"])!!}       
                     </div>
                    @foreach ($autor->file as $file)
                    <div class="form-group panel panel-default col-md-12">
                      <ul>
                    <li>{{$file->tipodoc->nombre}}

                      @if($file->extension=='pdf' || $file->extension=='jpeg' || $file->extension=='bmp' || $file->extension=='jpg' || $file->extension=='png')
                        <button type="button" class="btn btn-link" id="nuevo_documento" data-toggle="modal" data-target="#modal_documento" onclick="documentos_modal('{{$file->id}}','{{$file->extension}}')">Ver</button>
                      @else
                        {!!link_to_route('image.documentos', $title = 'Ver', $parameters = $file->id, $attributes = ['class'=>"btn btn-link"])!!}
                      @endif
                     </li>

                    </ul>
                    </div>                 

                     @endforeach


                     @else
                     <div class="form-group col-md-12">
                       <label>Documentos</label>
                       <p> No se ha ingresado ningún Documento.
                           {!!link_to_route('autor.editardocumentos', $title = "Agregar documentos", $parameters = $autor->id, $attributes = ['class'=>"btn btn-link"])!!}
                      </p>       
                     </div>

                    @endif