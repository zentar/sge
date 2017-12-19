 @if(count($libro->cotizacion) > 0)  
     <div class="form-group col-md-12">
      {!!link_to_route('libro.editarcotizacion', $title = "Editar cotizacion", $parameters = $libro->id, $attributes = ['class'=>"btn btn-link fa fa-plus"])!!}       
     </div>
       <div class="form-group panel panel-default col-md-12">

        <table class="table table-striped">
        <thead class="thead">
      <tr>
        <th style=" text-align: center;">ID</th>
        <th style=" text-align: center;">Imprenta</th>
        <th style=" text-align: center;">Valor</th>
        <th style=" text-align: center;">Tiraje</th>
        <th style=" text-align: center;">Aprobado</th>
      </tr>
    </thead>
     <tbody>
      @foreach ($libro->cotizacion as $cotizacion)      
    <tr>
    <td style=" text-align: center;">{{$cotizacion->id}}</td>  
    <td style=" text-align: center;">{{$cotizacion->imprenta}}</td>
    <td style=" text-align: center;">${{$cotizacion->valor}}  </td>
    <td style=" text-align: center;">{{$cotizacion->tiraje}}  </td>
    <td style=" text-align: center;">{{$cotizacion->estado}}  </td>
    <td>{!!link_to_route('image.documentos', $title = 'Ver', $parameters = $cotizacion->file->id, $attributes = ['class'=>"btn btn-link"])!!}</td>
    </tr>
      @endforeach
       </tbody>
      </table>
          </div>
      @else
        <div class="form-group col-md-12">
          <p> No se ha ingresado ninguna cotización.
              {!!link_to_route('libro.agregarcotizacion', $title = "Agregar cotizacion", $parameters = $libro->id, $attributes = ['class'=>"btn btn-link"])!!}
          </p>       
        </div>
  @endif