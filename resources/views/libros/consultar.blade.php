@extends('layouts.app')
@section('content')
  <h1 class="page-title">@lang('quickadmin.qa_li_consultar')</h1>
              <div class="box container col-md-6 ">
                <div class="box-body">
                  {!!Form::model($libro,['route'=> ['libro.update',$libro->id],'method'=>'PUT'])!!}
                     <div class="form-group col-md-12">                     
                      <label>Título</label> 
                       {!!Form::text('titulo',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100','disabled'])!!} 
                    </div>                

                    <div class="form-group col-md-12">
                      <label>Autores</label>

                    @foreach ($libro->autor as $name)
                    <input class="form-control col-md" placeholder="-" maxlength="10" disabled="" name="revision_pares" type="text" value="{{$name->nombre}} {{$name->apellido}}">
                     @endforeach
                    </div>

                    <div class="form-group col-md-6">
                      <label>Facultad</label>
                       {!!Form::text('facultad',$libro->facultad->nombre,['class'=>'form-control', 
                      'placeholder'=>'-','maxlength'=>'100','disabled'])!!}
                    </div>
                    <div class="form-group col-md-6">
                      <label>Revisión de Pares</label>
                        {!!Form::text('revision_pares',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'10','disabled'])!!}
                    </div>
                    <div class="form-group col-md-6">
                      <label>Contrato</label>
                        {!!Form::text('contrato',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'10','disabled'])!!}
                    </div>
                    <div class="form-group col-md-6">
                      <label>ISBN</label>
                        {!!Form::text('isbn',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100','disabled'])!!}
                    </div>
                     <div class="form-group col-md-6">
                      <label>PI</label>
                        {!!Form::text('pi',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100','disabled'])!!}
                    </div>
                     <div class="form-group col-md-6">
                      <label>N paginas</label>
                      {!!Form::text('paginas',null,['class'=>'form-control', 
                      'placeholder'=>'-','maxlength'=>'100','disabled'])!!}
                    </div>  
                    
                    <div class="form-group col-md-6">
                      <label>Estado</label>
                        {!!Form::text('estado_id',$libro->estados->nombre,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100','disabled'])!!}
                    </div>

                    <div class="form-group col-md-6">
                      <label>Coleccion</label>
                        {!!Form::text('coleccion_id',$libro->coleccion->titulo,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100','disabled'])!!}
                    </div>

                    @if($libro->capitulos->count() > 0)  
                    <div class="form-group col-md-12">
                       <label>Capítulos</label>
                     </div>
                    @foreach ($libro->capitulos as $capitulos)
                    <div class="form-group panel panel-default col-md-6">
                      <ul>
                    <li> {{$capitulos->titulo}}</li>
                    <strong>{{$capitulos->descripcion}}</strong>
                             <ul>
                                  @foreach ($capitulos->autor as $autor)
                                 <p>{{$autor->nombre}} {{$autor->apellido}}</p>
                                 @endforeach 
                             </ul>

                  </ul>
                    </div>                      
                     @endforeach
                    @endif
                  
                  {!!Form::close()!!}
                     <div class="col-md-12">
                      {!! link_to_route('admin.home', $title = 'Regresar',$parameters =[],$attributes = ['class'=>"btn btn-primary"] ) !!}
                    </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->


<div class="container col-md-12">
  <h2>Libro</h2>
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Información</a></li>
    <li><a data-toggle="tab" href="#estado2">Documentos</a></li>
    <li><a data-toggle="tab" href="#estado3">Caracteristicas</a></li>
    <li><a data-toggle="tab" href="#estado4">Cotizaciones</a></li>
    <li><a data-toggle="tab" href="#estado5">Historico</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
         <div class="form-group col-md-12">                     
                      <label>Título</label> 
                       {!!Form::text('titulo',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100','disabled'])!!} 
                    </div>                

                    <div class="form-group col-md-12">
                      <label>Autores</label>

                    @foreach ($libro->autor as $name)
                    <input class="form-control col-md" placeholder="-" maxlength="10" disabled="" name="revision_pares" type="text" value="{{$name->nombre}} {{$name->apellido}}">
                     @endforeach
                    </div>

                    <div class="form-group col-md-6">
                      <label>Facultad</label>
                       {!!Form::text('facultad',$libro->facultad->nombre,['class'=>'form-control', 
                      'placeholder'=>'-','maxlength'=>'100','disabled'])!!}
                    </div>
                     <div class="form-group col-md-6">
                      <label>N paginas</label>
                      {!!Form::text('paginas',null,['class'=>'form-control', 
                      'placeholder'=>'-','maxlength'=>'100','disabled'])!!}
                    </div>  
                    
                    <div class="form-group col-md-6">
                      <label>Estado</label>
                        {!!Form::text('estado_id',$libro->estados->nombre,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100','disabled'])!!}
                    </div>

                    <div class="form-group col-md-6">
                      <label>Coleccion</label>
                        {!!Form::text('coleccion_id',$libro->coleccion->titulo,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100','disabled'])!!}
                    </div>

                     @if($libro->capitulos->count() > 0)  
                    <div class="form-group col-md-12">
                       <label>Capítulos</label>
                     </div>
                    @foreach ($libro->capitulos as $capitulos)
                    <div class="form-group panel panel-default col-md-6">
                      <ul>
                    <li> {{$capitulos->titulo}}</li>
                    <strong>{{$capitulos->descripcion}}</strong>
                             <ul>
                                  @foreach ($capitulos->autor as $autor)
                                 <p>{{$autor->nombre}} {{$autor->apellido}}</p>
                                 @endforeach 
                             </ul>

                  </ul>
                    </div>                      
                     @endforeach
                    @endif
    </div>
    <div id="estado2" class="tab-pane fade">
      <div class="form-group col-md-6">
                      <label>Revisión de Pares</label>
                        {!!Form::text('revision_pares',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'10','disabled'])!!}
                    </div>
                    <div class="form-group col-md-6">
                      <label>Contrato</label>
                        {!!Form::text('contrato',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'10','disabled'])!!}
                    </div>
                    <div class="form-group col-md-6">
                      <label>ISBN</label>
                        {!!Form::text('isbn',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100','disabled'])!!}
                    </div>
                     <div class="form-group col-md-6">
                      <label>PI</label>
                        {!!Form::text('pi',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100','disabled'])!!}
                    </div>
    </div>
    <div id="estado3" class="tab-pane fade">
      <h3>ESTADO 3: EDICION</h3>
      <button type="button" class="btn">DOCUMENTO</button>
    </div>
    <div id="estado4" class="tab-pane fade">
      <h3>ESTADO 4: CORRECCION EDICION</h3>
      <button type="button" class="btn">DOCUMENTO</button>
    </div>
    <div id="estado5" class="tab-pane fade">
      <h3>ESTADO 5: EDITADO</h3>
      <button type="button" class="btn">DOCUMENTO</button>
    </div>
  </div>

</div>

    <div class="col-md-12">
                      {!! link_to_route('admin.home', $title = 'Regresar',$parameters =[],$attributes = ['class'=>"btn btn-primary"] ) !!}
                    </div>        
             
               
@stop