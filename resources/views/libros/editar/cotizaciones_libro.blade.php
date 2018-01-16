
{!!Form::close()!!}
<div  class="col-md-12">
      <div class="row col-md-12">
        <div class=" form-group col-md-6">
          <button type="button" class="btn btn-success" onclick="nuevoCotizacion()" id="modal_libro" data-toggle="modal" data-target="#modal_cot_libro">Nuevo</button>       
  @if(count($libro->cotizacion)>0)<button type="button" class="btn btn-warning" id="aprobar_cot" data-toggle="modal" data-target="#modal_aprob_cot_libro">Aprobar</button>  @endif     
           </div> 
           @if(count($libro->cotizacion)>0)   
            <div class=" form-group col-md-6" style="text-align:right;">    
          {!!link_to_route('libro.reporteCotizacion', $title = " Word", $parameters = [$libro->id,"docx"], $attributes = ['class'=>"btn btn-primary fa fa-file-word-o","target"=>"_blank"])!!} 
          {!!link_to_route('libro.reporteCotizacion', $title = " PDF", $parameters = [$libro->id,"pdf"], $attributes = ['class'=>"btn btn-danger fa fa-file-pdf-o  ","target"=>"_blank"])!!}    
          {!!link_to_route('libro.reporteCotizacion', $title = " Excel", $parameters = [$libro->id,"xlsx"], $attributes = ['class'=>"btn btn-success fa fa-file-excel-o  ","target"=>"_blank"])!!}    
          </div>
          @endif
         
       </div>

       <div class = "espacio col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"></div>  

         <table id="documentos_libro" class="table responsive table-striped table-bordered display compact cotizaciones" cellspacing="0" width="100%">
        <thead>
            <tr>                 
                <th class="dt-head-center">ID</th>
                <th class="dt-head-center">Imprenta</th>
                <th class="dt-head-center">Tiraje</th>
                <th class="dt-head-center">Valor ($)</th>
                <th class="dt-head-center">Total ($)</th>
                <th class="dt-head-center">Estado</th>
                <th class="dt-head-center"></th> 
            </tr>
        </thead>
       
        <tbody>
      
          @foreach($libro->cotizacion as $file)
           <tr @if($file->estado > 0) style="background-color:#59ea7d;" @endif >
                <td @if($file->estado > 0) style="background-color:#59ea7d;" @endif class="dt-body-center">{{$loop->index+1}}</td>
                <td class="dt-body-left">{{$file->imprenta}}</td>
                <td class="dt-body-right">{{$file->tiraje}}</td>
                <td class="dt-body-right">${{$file->valor}}</td>
                <td class="dt-body-right">${{$file->total}}</td>
                <td class="dt-body-center">@if($file->estado > 0)
                  @if($file->estado > 0)
              @foreach($libro->file as $fil)
                 @if($fil->tipodoc_id==2)

                 @if($fil->extension=='pdf' || $fil->extension=='jpeg' ||$fil->extension=='bmp' || $fil->extension=='jpg' || $fil->extension=='png')
                <button type="button" class="btn btn-link" id="nuevo_documento" data-toggle="modal" data-target="#modal_documento" onclick="documentos_modal('{{ $fil->id}}','{{ $fil->extension}}','{{$fil->nombre}}')">Aprobado</button>
              @else
              {!!link_to_route('image.documentos', $title = 'Aprobado', $parameters = $fil->id, $attributes = ['class'=>"btn btn-link"])!!}
             
              @endif

                  @endif
              @endforeach 
               @endif

                 @else - @endif</td>               
                <td class="dt-body-center"> 
              <p>
                @if($file->file->extension=='pdf' || $file->file->extension=='jpeg' ||$file->file->extension=='bmp' || $file->file->extension=='jpg' || $file->file->extension=='png')
                <button type="button" class="btn btn-primary fa fa-eye" id="nuevo_documento" data-toggle="modal" data-target="#modal_documento" onclick="documentos_modal('{{ $file->file->id}}','{{ $file->file->extension}}','{{$file->file->nombre}}')"></button>
                @else
                {!!link_to_route('image.documentos', $title = '', $parameters = $file->file->id, $attributes = ['class'=>"btn btn-primary fa fa-download"])!!}
                @endif


                <button type="button" href="" class="btn btn-warning btn-md fa fa-pencil-square-o" onclick="editar_cotizacion({{$file->id}},{{$file->file_id}},'{{$file->imprenta}}','{{$file->tiraje}}','{{$file->valor}}','{{$file->iva}}')"></button>

                {!!link_to_route('image.delete_cotizacion', $title = '', $parameters = $file->id, $attributes = ['class'=>"btn btn-danger fa fa-trash-o",'onclick'=>'return confirm("Esta seguro de borrar este registro?")'])!!}
               </p>
                </td> 
              </tr>
              @endforeach
      

        </tbody>
      </table> 
  </div>        


 {{-- ELIMINAR CUANDO SE ACEPTE POP OUT DE COTIZACIONES
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
         <option value="{{ $file->id }}">{{$loop->index+1}} - {{$file->imprenta}} - {{$file->tiraje}} - {{$file->valor}} </option>
        @endforeach
        </select>
        </div>         
        
        <div class="form-group col-md-4">                     
              <input type="file" id="documento" name="documento">
            </div>
        <button type="submit" class="btn btn-primary"> Aprobar</button> 
        {!!Form::close()!!}  
        </div>      
     --}}