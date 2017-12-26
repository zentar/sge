 @if(count($libro->cotizacion) > 0)  
        <div class="col-md-12">
          <table id="example1" class="table table-striped table-bordered display compact consultarCotizacion" cellspacing="0" width="100%">
        <thead>
            <tr>
            <th style=" text-align: center;">ID</th>
            <th style=" text-align: center;">Imprenta</th>
            <th style=" text-align: center;">Valor</th>
            <th style=" text-align: center;">Tiraje</th>
            <th style=" text-align: center;">Aprobado</th> 
            <th style=" text-align: center;"></th> 
            </tr>
        </thead>  
        <tbody>
             @if($libro->cotizacion->count() > 0)  
             @foreach ($libro->cotizacion as $cotizacion)   
                <tr>
                <td style=" text-align: center;">{{$cotizacion->id}}</td>  
                <td style=" text-align: center;">{{$cotizacion->imprenta}}</td>
                <td style=" text-align: center;">${{$cotizacion->valor}}  </td>
                <td style=" text-align: center;">{{$cotizacion->tiraje}}  </td>
                <td style=" text-align: center;">{{$cotizacion->estado}}  </td>
                <td>{!!link_to_route('image.documentos', $title = 'Ver', $parameters = $cotizacion->file->id, $attributes = ['class'=>"btn btn-link"])!!}
                
                
                @if($cotizacion->estado > 0)
              @foreach($libro->file as $file)
                 @if($file->tipodoc_id==2)
                 {!!link_to_route('image.documentos', $title = 'Aprobado', $parameters = $file->id, $attributes = ['class'=>"btn btn-link"])!!}
                 @endif
              @endforeach 
               @endif
                
                </td>
                </tr>
              @endforeach
                @endif
        </tbody>
      </table>          </div>
      
      @else
        <div class="form-group col-md-12">
          <p> No se ha ingresado ninguna cotización. </p>       
        </div>
  @endif


