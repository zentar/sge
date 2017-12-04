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
           
             
               
@stop