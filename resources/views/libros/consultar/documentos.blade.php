      <table id="documentos_libro" class="table responsive table-striped table-bordered filelibro" cellspacing="0" width="100%">
     <thead>
         <tr>
              
             <th class="dt-head-center">ID</th>
             <th class="dt-head-center">Tipo Documento</th>  
             <th class="dt-head-center">Extensión</th>
             <th class="dt-head-center">Observación</th>
             <th class="dt-head-center"></th> 
         </tr>
     </thead>
     <tfoot>
         <tr>
                 
             <th class="dt-head-center">ID</th>
             <th class="dt-head-center">Tipo Documento</th>
             <th class="dt-head-center">Extensión</th>
             <th class="dt-head-center">Observación</th>
             <th class="dt-head-center"></th>             
         </tr>
     </tfoot>
     <tbody>
   
       @foreach($libro->archivo as $file)
       @if($file->tipodoc->id != 23)
       @if( $file->tipodoc->id != 20)
       <tr>
             <td class="dt-body-left">{{$loop->index+1}}</td>
             <td class="dt-body-left">{{$file->tipodoc->nombre}}</td>
             <td class="dt-body-left">{{$file->extension}}</td>  
             <td class="dt-body-left">{{$file->observaciones}}</td>                
             <td class="dt-body-center"> 
           <p>

           @if($file->extension=='pdf' || $file->extension=='jpeg' ||$file->extension=='bmp' || $file->extension=='jpg' || $file->extension=='png')
             <button type="button" class="btn btn-primary fa fa-eye" id="nuevo_documento" data-toggle="modal" data-target="#modal_documento" onclick="documentos_modal('{{ $file->id}}','{{ $file->extension}}','{{$file->nombre}}')"></button>
           @else
           {!!link_to_route('image.documentos', $title = '', $parameters = $file->id, $attributes = ['class'=>"btn btn-primary fa fa-download"])!!}
           @endif
            </p>
             </td> 
           </tr>
           @endif
           @endif

           
          @endforeach           
     
     </tbody>
   </table> 
          {!!Form::close()!!}