@extends('layouts.app')
@section('content')
              <div class="box container col-md-6 ">
                <div class="box-body">
                  {!!Form::model($libro,['route'=> ['libro.update',$libro->id],'method'=>'PUT'])!!}
                     <div class="form-group">                     
                      <label>Título</label> 
                       {!!Form::text('titulo',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100','disabled'])!!} 
                    </div>                

                    <div class="form-group">
                      <label>Autores</label>

                    @foreach ($libro->autor as $name)
                    <input class="form-control" placeholder="-" maxlength="10" disabled="" name="revision_pares" type="text" value="{{$name->nombre}} {{$name->apellido}}">
                     @endforeach
                    </div>

                    <div class="form-group">
                      <label>Facultad</label>
                       {!!Form::text('facultad',null,['class'=>'form-control', 
                      'placeholder'=>'-','maxlength'=>'100','disabled'])!!}
                    </div>
                    <div class="form-group">
                      <label>Revisión de Pares</label>
                        {!!Form::text('revision_pares',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'10','disabled'])!!}
                    </div>
                    <div class="form-group">
                      <label>Contrato</label>
                        {!!Form::text('contrato',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'10','disabled'])!!}
                    </div>
                    <div class="form-group">
                      <label>ISBN</label>
                        {!!Form::text('isbn',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100','disabled'])!!}
                    </div>
                     <div class="form-group">
                      <label>PI</label>
                        {!!Form::text('pi',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100','disabled'])!!}
                    </div>
                     <div class="form-group">
                      <label>N paginas</label>
                      {!!Form::text('paginas',null,['class'=>'form-control', 
                      'placeholder'=>'-','maxlength'=>'100','disabled'])!!}
                    </div>                    
                  {!!Form::close()!!}

                      {!! link_to_route('admin.home', $title = 'Regresar',$parameters =[],$attributes = ['class'=>"btn btn-primary"] ) !!}</p>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
           
             
               
@stop