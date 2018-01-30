@extends('layouts.app')
@section('content')

  @include('general/autor_modal') 

  <div class="box container">
                <div class="box-body">
                  {!!Form::open(['route'=>'libro.capitulos', 'method'=>'POST', 'id'=>"crear_capitulos_libro",'name'=>"crear_capitulos_libro"])!!}
                  <div class="col-md-12">
                   <div class="form-group">

                   <label>Libros</label>
                   <div class="panel panel-default">
                     <div class="panel-body">{{$libro->titulo}}</div>
                     {{ Form::hidden('libro_id', $libro->id) }}
                   </div> 

               <a type="button" href="{{route('libro.editar',$libro->id)}}" class="btn btn-primary fa fa-arrow-left"></a>

               <button type="button" class="btn btn-success" id="nuevo_capitulo" onclick="nuevoCapitulo()" >Nuevo</button>

               <button type="submit" class="btn btn-primary" id="grabar_capitulos">Grabar</button>

           
     
             </div></div> 
               <div class='panel panel-body'>

                  <div class='form-group col-md-6'>
                    <input class='form-control' id='titulo' placeholder='Titulo' maxlength='200' name='titulo' type='text' value=''></div>

                  <div class='form-group col-md-6'>
                    <input class='form-control' id='descripcion' placeholder='Descripcion' maxlength='200' name='descripcion' type='text' value=''></div>

                  <div class='form-group col-md-6'><select id='autores' style='width: 100%' class='form-control select2' name='autores[]'><option value='null'>Seleccionar Autor </option>@foreach($autores as $autor)<option value='{{ $autor->id }}' @if(Session::get('facultad_old') == $autor->id) selected @endif> {{ $autor->nombre }} {{ $autor->apellido }} </option>@endforeach</select></div>

                <div class='form-group col-xs-12 col-sm-12 col-md-6 col-lg-6'>  
                      <button type='button' class='btn btn-primary fa fa-arrow-down' id='Agregar_autores1' onclick="myFunction()"></button>
                        <button type="button" class="btn btn-success fa fa-plus" id="nuevo_autores" data-toggle="modal" data-target=".bd-example-modal-lg"></button>               
                </div>

                <div class="col-md-6" id="demo"></div>

                <div class='col-md-12' style="padding-top: 3%;">
                
                     <table id="example1" class="table table-striped table-bordered display compact capitulos" cellspacing="0" width="100%">
        <thead>
            <tr>
                 
                <th class="dt-head-center">ID</th>
                <th class="dt-head-center">Título</th>
                <th class="dt-head-center">Autores</th>
                <th class="dt-head-center">Descripción</th>
       
                <th class="dt-head-center"></th>   
            </tr>
        </thead>
        <tfoot>
            <tr>
                 
                <th class="dt-head-center">ID</th>
                <th class="dt-head-center">Título</th>
                <th class="dt-head-center">Autores</th>
                <th class="dt-head-center">Descripción</th>
          
                <th class="dt-head-center"></th>             
            </tr>
        </tfoot>
        <tbody>
             @if($libro->capitulos->count() > 0)  
                @foreach ($libro->capitulos as $capitulos)
              
            <tr>
                <td class="dt-body-left">{{$capitulos->id}}</td>
                <td class="dt-body-left">{{$capitulos->titulo}}</td>
           
                 <td class="dt-body-left">
                 
                  @foreach ($capitulos->autor as $autor)
                   <p>{{$autor->nombre}} {{$autor->apellido}}</p>
                  @endforeach 
                </td>
                <td class="dt-body-left">{{$capitulos->descripcion}}</td>
                <td class="dt-body-center">          
                <button type="button" href="" class="btn btn-warning btn-md fa fa-pencil-square-o" onclick="editar_capitulo({{$capitulos->id}},'{{$capitulos->titulo}}','{{$capitulos->descripcion}}',{{$capitulos->autor}})"></button>
              
                {!!link_to_route('capitulo.delete', $title = '', $parameters = $capitulos->id, $attributes = ['class'=>"btn btn-danger btn-md fa fa-trash-o ",'onclick'=>'return confirm("Esta seguro de borrar este registro?")'])!!}            
                </td>
            </tr>
              @endforeach
                @endif

        </tbody>
      </table>  
      </div>
</div></div>

<div id="demo2" name="demo2" style="display: none;"></div>
{!!Form::close()!!}  
</div>
@stop


@section('especial')
<script>
//EVALUA QUE MODAL PRESENTAR CON LOS ERRORES
       @if ($errors->count() > 0 and Session::get('error_code') == 5)
       $(function() {
           $('#modal_autor').modal('show');
       });
       @endif
</script>

<script>
       @if (Session::get('modal_autor') == 1)
       $(function() {
           $('#modal_autor').modal('show');
       });
       @endif
</script>

@stop