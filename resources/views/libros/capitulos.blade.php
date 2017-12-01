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
               
                     <div class="form-group">                      {!!Form::text('titulo_capitulo',Request::old('titulo_capitulo'),['class'=>'form-control','placeholder'=>'Ingrese capitulo','maxlength'=>'200'])!!} 
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


 <div class="box container col-md-6 ">
                <div class="box-body">
                  {!!Form::open(['route'=>'libro.capitulos', 'method'=>'POST', 'id'=>"crear_capitulos_libro",'name'=>"crear_capitulos_libro"])!!}
                  <div class="col-md-12">
                   <div class="form-group">

                   <label>Libros</label>
                   {!!Form::select('libro_id',$libro_nombre,null,['class'=>'form-control select2','style'=>'width: 100%;','id'=>'libro_id'])!!}
                    </div>

               <button type="button" class="btn btn-primary" id="Agregar_capitulos" onclick="agregarCapitulo()">Agregar</button>
               <button type="submit" class="btn btn-primary" id="grabar_capitulos">Grabar</button>
             </div></div> 


         <div id="capitulos">
          {{--<div class='panel panel-default'><div class='panel-heading'><h3 class='panel-title'>Capítulo "+capitulo_global+"</h3></div><div class='panel-body'><div class='form-group col-md-6'><input class='form-control' placeholder='Titulo' maxlength='200' name='titulo"+capitulo_global+"' type='text' value=""></div><div class='form-group col-md-6'><input class='form-control' placeholder='Descripcion' maxlength='200' name='descripcion"+capitulo_global+"' type='text' value=""></div><div class='form-group col-md-6'><select id='autores"+capitulo_global+"' style='width: 100%' class='form-control select2' name='autores"+capitulo_global+"'><option value='null'>Seleccionar Autor </option>@foreach($autores as $autor)<option value='{{ $autor->id }}' @if(Session::get('facultad_old') == $autor->id) selected @endif> {{ $autor->nombre }} {{ $autor->apellido }} </option>@endforeach</select></div><div class='form-group col-xs-12 col-sm-12 col-md-6 col-lg-6'><div class='form-group  col-xs-12 col-sm-6 col-md-6 col-lg-2'><button type='button' class='btn btn-primary col-sm-12 col-md-12 col-lg-12' id='Agregar_autores"+capitulo_global+"' onclick='myFunction()'>Agregar</button></div><div class='form-group  col-xs-12 col-sm-6 col-md-6 col-lg-2'><button type='button' class='btn btn-danger col-sm-12 col-md-12 col-lg-12' id='nuevo_autores"+capitulo_global+"' data-toggle='modal' data-target='.bd-example-modal-lg'>Quitar</button></div></div><div id='demo"+capitulo_global+"'></div></div></div>--}}


        </div>
      {!!Form::close()!!}

      </div>
  


             
               
@stop


