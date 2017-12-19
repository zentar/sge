@extends('layouts.app')
@section('content')
  <div class="box container">
                <div class="box-body">
                   {!!Form::open(['route'=>'image.crear_cotizacion', 'method'=>'POST','files'=>'true', 'id'=>"crear_libro_cotizacion",'name'=>"crear_libro_cotizacion"])!!}
             <div class="col-md-12">
                   <div class="form-group">

                   <label>Libro</label>
                   <div class="panel panel-default">
                     <div class="panel-body">{{$libro->titulo}}</div>
                     {{ Form::hidden('libro_id', $libro->id) }}
                   </div>
               <a type="button" href="{{route('libro.editar',$libro->id)}}" class="btn btn-primary fa fa-arrow-left"></a> 

               <button type="button" class="btn btn-success" id="nuevo_capitulo" onclick="nuevoCotizacion()" >Nuevo</button>   

               <button type="submit" class="btn btn-primary" id="agregar_documento_autor">Grabar</button>     
     
             </div></div>

             <div class="col-md-12">

                <div class='form-group col-md-6'>
                  <input class='form-control' id='imprenta' placeholder='Imprenta' maxlength='200' name='imprenta' type='text' value=''>
                </div>

                  <div class='form-group col-md-6'>
                  <input class='form-control' id='tiraje' placeholder='Tiraje' maxlength='200' name='tiraje' type='text' value=''>
                </div>

                <div class='form-group col-md-6'>
                  <input class='form-control' id='valor' placeholder='Valor' maxlength='200' name='valor' type='text' value=''>
                </div>


              <div class="form-group col-md-4">                     
                <input type="file" id="documento" name="documento">
              </div>
              </div>

         <table id="documentos_libro" class="table table-striped table-bordered display compact cotizaciones" cellspacing="0" width="100%">
        <thead>
            <tr>                 
                <th class="dt-head-center">ID</th>
                <th class="dt-head-center">Imprenta</th>
                <th class="dt-head-center">Tiraje</th>
                <th class="dt-head-center">Valor</th>
                <th class="dt-head-center">Estado</th>
                <th class="dt-head-center"></th> 
            </tr>
        </thead>
        <tfoot>
            <tr>                    
                <th class="dt-head-center">ID</th>
                <th class="dt-head-center">Imprenta</th>
                <th class="dt-head-center">Tiraje</th>
                <th class="dt-head-center">Valor</th>
                <th class="dt-head-center">Estado</th>
                <th class="dt-head-center"></th>             
            </tr>
        </tfoot>
        <tbody>
      
          @foreach($libro->cotizacion as $file)
           <tr>
                <td class="dt-body-center">{{$file->id}}</td>
                <td class="dt-body-center">{{$file->imprenta}}</td>
                <td class="dt-body-center">{{$file->tiraje}}</td>
                <td class="dt-body-center">{{$file->valor}}</td>
                <td class="dt-body-center">{{$file->estado}}</td>               
                <td class="dt-body-center"> 
              <p>
                {!!link_to_route('image.documentos', $title = '', $parameters = $file->file->id, $attributes = ['class'=>"btn btn-primary fa fa-eye"])!!}

                <button type="button" href="" class="btn btn-warning btn-md fa fa-pencil-square-o" onclick="editar_cotizacion({{$file->id}},{{$file->file_id}},'{{$file->imprenta}}','{{$file->tiraje}}',{{$file->valor}})"></button>

                {!!link_to_route('image.delete_cotizacion', $title = '', $parameters = $file->id, $attributes = ['class'=>"btn btn-danger fa fa-trash-o",'onclick'=>'return confirm("Esta seguro de borrar este registro?")'])!!}
               </p>
                </td> 
              </tr>
              @endforeach
      

        </tbody>
      </table> 
           {!!Form::close()!!}
                </div></div>
@stop


