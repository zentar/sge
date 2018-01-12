      
             <div class="col-md-12">
                <div class="form-group"> 
               <button type="button" class="btn btn-success" id="modal_libro" data-toggle="modal" data-target="#modal_doc_libro">Nuevo</button>     
     
             </div></div>
       
         <table id="documentos_libro" class="table responsive table-striped table-bordered filelibro" cellspacing="0" width="100%">
        <thead>
            <tr>
                 
                <th class="dt-head-center">ID</th>
                <th class="dt-head-center">Tipo Documento</th>
            {{--<th class="dt-head-center">Nombre actual</th>
                <th class="dt-head-center">Nombre subida</th>
                <th class="dt-head-center">Ruta</th>
                <th class="dt-head-center">Peso</th> --}}
                <th class="dt-head-center">Extensión</th>
                <th class="dt-head-center"></th> 
            </tr>
        </thead>
        <tfoot>
            <tr>
                    
                <th class="dt-head-center">ID</th>
                <th class="dt-head-center">Tipo Documento</th>
                {{--<th class="dt-head-center">Nombre actual</th>
                    <th class="dt-head-center">Nombre subida</th>
                    <th class="dt-head-center">Ruta</th>
                    <th class="dt-head-center">Peso</th> --}}
                <th class="dt-head-center">Extensión</th>
                <th class="dt-head-center"></th>             
            </tr>
        </tfoot>
        <tbody>
      
          @foreach($libro->file as $file)
          <tr>
                <td class="dt-body-center">{{$file->id}}</td>
                <td class="dt-body-center">{{$file->tipodoc->nombre}}</td>
              {{--  <td class="dt-body-center">{{$file->nombre}}</td>
                <td class="dt-body-center">{{$file->nombre_subida}}</td>
                <td class="dt-body-center">{{$file->ruta}}</td>
                <td class="dt-body-center">{{$file->peso}}</td> --}} 
                <td class="dt-body-center">{{$file->extension}}</td>                
                <td class="dt-body-center"> 
              <p>

              @if($file->extension=='pdf' || $file->extension=='jpeg' ||$file->extension=='bmp' || $file->extension=='jpg' || $file->extension=='png')
                <button type="button" class="btn btn-primary fa fa-eye" id="nuevo_documento" data-toggle="modal" data-target="#modal_documento" onclick="documentos_modal('{{ $file->id}}','{{ $file->extension}}','{{$file->nombre}}')"></button>
              @else
              {!!link_to_route('image.documentos', $title = '', $parameters = $file->id, $attributes = ['class'=>"btn btn-primary fa fa-download"])!!}
              @endif

                {!!link_to_route('image.delete_libro', $title = '', $parameters = $file->id, $attributes = ['class'=>"btn btn-danger fa fa-trash-o",'onclick'=>'return confirm("Esta seguro de borrar el documento '.$file->tipodoc->nombre.'?")'])!!}
               </p>
                </td> 
              </tr>
             @endforeach           

        </tbody>
      </table> 

             {!!Form::close()!!}