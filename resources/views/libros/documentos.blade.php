@extends('layouts.app')
@section('content')
  <div class="box container">
                <div class="box-body">
                   {!!Form::open(['route'=>'image.crear_libro', 'method'=>'POST','files'=>'true', 'id'=>"crear_libro_documentos",'name'=>"crear_libro_documentos"])!!}
             <div class="col-md-12">
                   <div class="form-group">

                   <label>Libro</label>
                   <div class="panel panel-default">
                     <div class="panel-body">{{$libro->titulo}}</div>
                     {{ Form::hidden('libro_id', $libro->id) }}
                   </div>
               <a type="button" href="{{route('libro.editar',$libro->id)}}" class="btn btn-primary fa fa-arrow-left"></a>    

               <button type="submit" class="btn btn-primary" id="agregar_documento_autor">Grabar</button>     
     
             </div></div>

             <div class="col-md-12">

              <div class="form-group col-md-4">                     
                        {!!Form::File('documento')!!}
                    </div>

        <div class='form-group col-md-8'><select id='tipo_doc' style='width: 100%' class='form-control select2' name='tipo_doc[]'><option value='null'>Seleccionar Tipo Documento </option>@foreach($tipos as $tipo)<option value='{{ $tipo->id }}'> {{ $tipo->nombre }}</option>@endforeach</select></div>

      </div>



         <table id="documentos_libro" class="table table-striped table-bordered display compact filelibro" cellspacing="0" width="100%">
        <thead>
            <tr>
                 
                <th class="dt-head-center">ID</th>
                <th class="dt-head-center">Tipo Documento</th>
                <th class="dt-head-center">Nombre actual</th>
                <th class="dt-head-center">Nombre subida</th>
                <th class="dt-head-center">Ruta</th>
                <th class="dt-head-center">Peso</th>
                <th class="dt-head-center">Extension</th>
                <th class="dt-head-center"></th> 
            </tr>
        </thead>
        <tfoot>
            <tr>
                    
                <th class="dt-head-center">ID</th>
                <th class="dt-head-center">Tipo Documento</th>
                <th class="dt-head-center">Nombre actual</th>
                <th class="dt-head-center">Nombre subida</th>
                <th class="dt-head-center">Ruta</th>
                <th class="dt-head-center">Peso</th>
                <th class="dt-head-center">Extension</th>
                <th class="dt-head-center"></th>             
            </tr>
        </tfoot>
        <tbody>
      
          @foreach($libro->file as $file)
          <tr>
                <td class="dt-body-center">{{$file->id}}</td>
                <td class="dt-body-center">{{$file->tipodoc->nombre}}</td>
                <td class="dt-body-center">{{$file->nombre}}</td>
                <td class="dt-body-center">{{$file->nombre_subida}}</td>
                <td class="dt-body-center">{{$file->ruta}}</td>
                <td class="dt-body-center">{{$file->peso}}</td> 
                <td class="dt-body-center">{{$file->extension}}</td>                
                <td class="dt-body-center"> 
              <p>
                {!!link_to_route('image.documentos', $title = '', $parameters = $file->id, $attributes = ['class'=>"btn btn-primary fa fa-eye"])!!}

                {!!link_to_route('image.delete_libro', $title = '', $parameters = $file->id, $attributes = ['class'=>"btn btn-danger fa fa-trash-o",'onclick'=>'return confirm("Esta seguro de borrar este registro?")'])!!}
               </p>
                </td> 
              </tr>
             @endforeach
           

        </tbody>
      </table> 
           {!!Form::close()!!}
                </div></div>
@stop


