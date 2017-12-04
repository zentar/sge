@extends('layouts.app')
@section('content')
   {{--    <h1 class="page-title">@lang('quickadmin.qa_li_capitulos')</h1>
            <div class="box container col-md-6 ">
                <div class="box-body">
                  <div class="col-md-12">
                   <div class="form-group">
                      <label>Libros</label>
                   {!!Form::select('libro_id',$libro_nombre,null,['class'=>'form-control select2','style'=>'width: 100%;','id'=>'libro_id'])!!}
                    </div>
               
                     <div class="form-group">                      
                      {!!Form::text('titulo_capitulo',Request::old('titulo_capitulo'),['class'=>'form-control','placeholder'=>'Ingrese capitulo','maxlength'=>'200'])!!} 
                     </div>

                  <button type="button" class="btn btn-primary" id="Agregar_capitulos" onclick="agregarCapitulo()">Agregar</button> 
                   </div>
                  </div>

          <div id="capitulos">
                 <div class="panel panel-default"><div class="panel-heading"><h3 class="panel-title">Capítulo1</h3></div><div class="panel-body"><div class="form-group col-md-6"><input class="form-control" placeholder="Ingrese capitulo" disabled maxlength="200" name="titulo_capitulo" type="text"></div><div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                     <div class="form-group  col-xs-12 col-sm-6 col-md-6 col-lg-2"><button type="button" class="btn btn-primary col-sm-12 col-md-12 col-lg-12" id="Agregar_autores" onclick="myFunction()">Agregar</button></div><div class="form-group  col-xs-12 col-sm-6 col-md-6 col-lg-2"><button type="button" class="btn btn-primary col-sm-12 col-md-12 col-lg-12" id="nuevo_autores" onclick="myFunction()">Quitar</button></div></div></div></div>
            </div>

            </div>
            </div>--}}


 <div class="box container">
                <div class="box-body">
                  {!!Form::open(['route'=>'libro.capitulos', 'method'=>'POST', 'id'=>"crear_capitulos_libro",'name'=>"crear_capitulos_libro"])!!}
                  <div class="col-md">
                   <div class="form-group">

                   <label>Libros</label>
                   <div class="panel panel-default">
                     <div class="panel-body">{{$libro->titulo}}</div>
                   </div>

               <button type="button" class="btn btn-primary" id="Agregar_capitulos" onclick="agregarCapitulo()">Agregar</button>
               <button type="submit" class="btn btn-primary" id="grabar_capitulos">Grabar</button>
             </div></div> 


         <div id="capitulos">
          @if($libro->capitulos->count() > 0)
              @foreach ($libro->capitulos as $capitulos)
              
                <div class="col-md-12" id="id_global{{$loop->iteration}}">
                 <div class='panel panel-body'>
                  <div class='form-group col-md-6'>
                    <input class='form-control' placeholder='Titulo' maxlength='200' name='titulo{{$loop->iteration}}' type='text' value='{{$capitulos->titulo}}''></div>
                  <div class='form-group col-md-6'>
                    <input class='form-control' placeholder='Descripcion' maxlength='200' name='descripcion{{$loop->iteration}}' type='text' value='{{$capitulos->descripcion}}'>
                  </div>
                  <div class='form-group col-md-6'><select id='autores{{$loop->iteration}}' style='width: 100%' class='form-control select2' name='autores[]'><option value='null'>Seleccionar Autor </option>@foreach($autores as $autor)<option value='{{ $autor->id }}' @if(Session::get('facultad_old') == $autor->id) selected @endif> {{ $autor->nombre }} {{ $autor->apellido }} </option>@endforeach</select></div>

                  <div class='form-group col-xs-12 col-sm-12 col-md-6 col-lg-6'>
                    <div class='form-group  col-xs-12 col-sm-6 col-md-6 col-lg-2'><button type='button' class='btn btn-primary col-sm-12 col-md-12 col-lg-12' id='Agregar_autores{{$loop->iteration}}' onclick="agregar_autores_capitulos('{{$loop->iteration}}')">Agregar</button></div>

                  <div class='form-group  col-xs-12 col-sm-6 col-md-6 col-lg-2'><button type='button' class='btn btn-danger col-sm-12 col-md-12 col-lg-12' id='nuevo_autores{{$loop->iteration}}' data-toggle='modal' onclick="eliminar_autores_capitulos('{{$loop->iteration}}')" data-target='.bd-example-modal-lg'>Quitar</button></div>

                </div>         

                  <div class="col-md-12" id='demo{{$loop->iteration}}'>
                      @foreach ($capitulos->autor as $autores_capitulos)
                              {{--$loop->parent->iteration--}}
                                 <div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>

                                  <input class='form-control col-xs-12 col-sm-12 col-md-12 col-lg-12' maxlength='200' disabled id='autors_capitulo{{$autores_capitulos->id}}{{$loop->parent->iteration}}' type='text' name='text[]' value='{{$autores_capitulos->nombre}}{{$autores_capitulos->apellido}}'></div>

                                  <div class='col-xs-12 col-sm-3 col-md-2 col-lg-1'>
                                  <button type='button' class='btn btn-danger col-xs-2 col-sm-12 col-md-12 col-lg-12' id='autor-capitulos-{{$autores_capitulos->id}}{{$loop->parent->iteration}}' onclick='myFunction2_capitulos({{$autores_capitulos->id}},{{$loop->parent->iteration}})'>Quitar </button></div>                               

                      @endforeach 
                      </div>
                    </div></div>
              @endforeach

           @endif 
      
      {!!Form::close()!!}

      </div>
  </div>
</div>             
               
@stop


