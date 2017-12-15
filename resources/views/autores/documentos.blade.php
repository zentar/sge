@extends('layouts.app')
@section('content')

    
  <div class="box container">
                <div class="box-body">
                   {!!Form::open(['route'=>'image.crear_autor', 'method'=>'POST','files'=>'true', 'id'=>"crear_autor_documentos",'name'=>"crear_autor_documentos"])!!}

             <div class="col-md-12">
                   <div class="form-group">

                   <label>Autor</label>
                   <div class="panel panel-default">
                     <div class="panel-body">{{$autor->nombre}} {{$autor->apellido}}</div>
                     {{ Form::hidden('autor_id', $autor->id) }}
                   </div> 

               <a type="button" href="{{route('autor.editar',$autor->id)}}" class="btn btn-primary fa fa-arrow-left"></a>

               <button type="button" class="btn btn-success" id="nuevo_documento_autor" onclick="nuevoCapitulo()" >Nuevo</button>

               <button type="submit" class="btn btn-primary" id="agregar_documento_autor">Grabar</button>     
     
             </div></div>

             <div class="col-md-12">       


              <div class="form-group col-md-4">                     
                        {!!Form::File('documento')!!}
                    </div>

        <div class='form-group col-md-8'><select id='tipo_doc' style='width: 100%' class='form-control select2' name='tipo_doc[]'><option value='null'>Seleccionar Tipo Documento </option>@foreach($tipos as $tipo)<option value='{{ $autor->id }}'> {{ $tipo->nombre }}</option>@endforeach</select></div>

      </div>



         <table id="example1" class="table table-striped table-bordered display compact fileautor" cellspacing="0" width="100%">
        <thead>
            <tr>
                 
                <th class="dt-head-center">ID</th>
                <th class="dt-head-center">nombre</th>
                <th class="dt-head-center">nombre_subida</th>
                <th class="dt-head-center">ruta</th>
                <th class="dt-head-center">peso</th>
                <th class="dt-head-center">extension</th>
                <th class="dt-head-center">img</th>
                <th class="dt-head-center"></th> 
            </tr>
        </thead>
        <tfoot>
            <tr>
                    
                <th class="dt-head-center">ID</th>
                <th class="dt-head-center">nombre</th>
                <th class="dt-head-center">nombre_subida</th>
                <th class="dt-head-center">ruta</th>
                <th class="dt-head-center">peso</th>
                <th class="dt-head-center">extension</th>
                <th class="dt-head-center">img</th>
                <th class="dt-head-center"></th>             
            </tr>
        </tfoot>
        <tbody>
      

        </tbody>
      </table> 
           {!!Form::close()!!}
                </div></div>
@stop


