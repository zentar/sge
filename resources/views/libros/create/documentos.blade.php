 @if(count($libro->file) > 0)  
     <div class="form-group col-md-12">
      {!!link_to_route('libro.editardocumentos', $title = "Editar documentos", $parameters = $libro->id, $attributes = ['class'=>"btn btn-link fa fa-plus"])!!}       
     </div>
      @foreach ($libro->file as $file)
        <div class="form-group panel panel-default col-md-12">
          <ul>
              <li>{{$file->tipodoc->nombre}}
              {!!link_to_route('image.documentos', $title = 'Ver', $parameters = $file->id, $attributes = ['class'=>"btn btn-link"])!!}
              </li>
          </ul>
        </div> 
      @endforeach
      @else
        <div class="form-group col-md-12">
          <p> No se ha ingresado ningún Documento.
              {!!link_to_route('libro.agregardocumentos', $title = "Agregar documentos", $parameters = $libro->id, $attributes = ['class'=>"btn btn-link"])!!}
          </p>       
        </div>
  @endif