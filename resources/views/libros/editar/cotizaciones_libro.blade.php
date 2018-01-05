
{!!Form::close()!!}
@if(count($libro->cotizacion) > 0) 
<div class="form-group col-md-12">
    {!!link_to_route('libro.editarcotizacion', $title = "Editar cotización", $parameters = $libro->id, $attributes = ['class'=>"btn btn-link fa fa-plus"])!!}       
   </div> 
      <div class="col-md-12">
        <table id="editar_cotizaciones" class="table table-striped table-bordered display compact consultarCotizacion" cellspacing="0" width="100%">
      <thead>
          <tr>
          <th style=" text-align: center;">#</th>
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
              <td style=" text-align: center;">{{$loop->index+1}}</td>  
              <td style=" text-align: center;">{{$cotizacion->imprenta}}</td>
              <td style=" text-align: center;">${{$cotizacion->valor}}  </td>
              <td style=" text-align: center;">{{$cotizacion->tiraje}}  </td>
              <td style=" text-align: center;">@if($cotizacion->estado > 0) Aprobado @else - @endif</td>
              <td style=" text-align: center;">
              
              @if($cotizacion->file->extension=='pdf' || $cotizacion->file->extension=='jpeg' ||$cotizacion->file->extension=='bmp' || $cotizacion->file->extension=='jpg' || $cotizacion->file->extension=='png')
                <button type="button" class="btn btn-link" id="nuevo_documento" data-toggle="modal" data-target="#modal_documento" onclick="documentos_modal('{{ $cotizacion->file->id}}','{{ $cotizacion->file->extension}}','{{$cotizacion->file->nombre}}')">Ver</button>
              @else
                 {!!link_to_route('image.documentos', $title = 'Ver', $parameters = $cotizacion->file->id, $attributes = ['class'=>"btn btn-link"])!!}
              @endif

              @if($cotizacion->estado > 0)
              @foreach($libro->file as $file)
                 @if($file->tipodoc_id==2)

                 @if($file->extension=='pdf' || $file->extension=='jpeg' ||$file->extension=='bmp' || $file->extension=='jpg' || $file->extension=='png')
                <button type="button" class="btn btn-link" id="nuevo_documento" data-toggle="modal" data-target="#modal_documento" onclick="documentos_modal('{{ $file->id}}','{{ $file->extension}}','{{$file->nombre}}')">Aprobado</button>
              @else
              {!!link_to_route('image.documentos', $title = 'Aprobado', $parameters = $file->id, $attributes = ['class'=>"btn btn-link"])!!}
             
              @endif

                  @endif
              @endforeach 
               @endif
               </td>
               
               </tr>
            @endforeach
              @endif

      </tbody>
    </table> 
    </div>
    <div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="margin-top:1%"></div>
    {!!Form::open(['route'=>'image.crear_cotizacion_aprobado','method'=>'POST','files'=>'true', 'id'=>"crear_libro_cotizacion_aprobado",'name'=>"crear_libro_cotizacion_aprobado"])!!}
    {{ Form::hidden('libro_id', $libro->id) }}
    <div class="form-group col-md-12">
    <div class="form-group col-md-12"> 
      <label>Aprobar Cotización</label> 
      </div>
      <div class="form-group col-md-6"> 
      <select id="aprobado_id" style="width: 100%" class="form-control" name="aprobado_id">
         <option value=null> Seleccionar Cotizacion </option>
        @foreach($libro->cotizacion as $file)
         <option value="{{ $file->id }}">Cotización {{$loop->index+1}}</option>
        @endforeach
        </select>
        </div>         
        
        <div class="form-group col-md-4">                     
              <input type="file" id="documento" name="documento">
            </div>
        <button type="submit" class="btn btn-primary"> Aprobar</button> 
        {!!Form::close()!!}  
        </div>
    @else
      <div class="form-group col-md-12">
        <p> No se ha ingresado ninguna cotización. {!!link_to_route('libro.editarcotizacion', $title = "Agregar cotización", $parameters = $libro->id, $attributes = ['class'=>"btn btn-link fa fa-plus"])!!}       
</p>       
      </div>
@endif
