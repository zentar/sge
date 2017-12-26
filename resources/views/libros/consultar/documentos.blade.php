 @if($libro->file->count() > 0)  

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
          <p> No se ha ingresado ningún Documento.</p>       
        </div>
  @endif