
{!!Form::close()!!}
<div  class="col-md-12">
       <div class = "espacio2 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"></div>  

       <div class ="col-md-12">
         <table id="documentos_libro" class="table responsive table-striped table-bordered display compact cotizaciones" cellspacing="0" width="100%">
        <thead>
            <tr>                 
                <th width="2%" class="dt-head-center">ID</th>
                <th width="20%" class="dt-head-center">Imprenta</th>
                <th width="10%" class="dt-head-center">Tiraje</th>
                <th width="10%" class="dt-head-center">Valor ($)</th>
                <th width="10%" class="dt-head-center">Total ($)</th>
                <th width="15%" class="dt-head-center">Estado</th>
            </tr>
        </thead>
       
        <tbody>
      
          @foreach($libro->cotizacion as $file)
           <tr @if($file->estado > 0) style="background-color:#87D37C;" @endif >
                <td width="2%" @if($file->estado > 0) style="background-color:#87D37C;" @endif class="dt-body-center">{{$loop->index+1}}</td>
                <td width="20%" class="dt-body-left">{{$file->imprenta}}</td>
                <td width="10%" class="dt-body-right">{{$file->tiraje}}</td>
                <td width="10%" class="dt-body-right">${{$file->valor}}</td>
                <td width="10%" class="dt-body-right">${{$file->total}}</td>
                <td width="15%" class="dt-body-center">@if($file->estado > 0)
                  @if($file->estado > 0)
              @foreach($libro->archivo as $fil)
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
              </tr>
              @endforeach
      

        </tbody>
      </table> 
      </div>
  </div>     



