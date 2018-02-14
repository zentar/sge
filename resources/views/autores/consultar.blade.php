@extends('layouts.app')
@section('content')

     <h1 class="page-title">@lang('quickadmin.qa_au_consultar')</h1>
              <div class="box container col-md-6 ">
                <div class="box-body">
                  {!!Form::model($autores,['route'=> ['autor.update',$autores->id],'method'=>'PUT'])!!}
                     <div class="form-group col-md-6">                     
                      <label>Cedula</label> 
                       {!!Form::text('cedula',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100','disabled'])!!} 
                    </div>
                    <div class="form-group col-md-6">
                      <label>Nombre</label>
                      {!!Form::text('nombre',null,['class'=>'form-control', 
                      'placeholder'=>'-','maxlength'=>'100','disabled'])!!}
                    </div>
                    <div class="form-group col-md-6">
                      <label>Apellido</label>
                       {!!Form::text('apellido',null,['class'=>'form-control', 
                      'placeholder'=>'-','maxlength'=>'100','disabled'])!!}
                    </div>
                    <div class="form-group col-md-6">
                      <label>Email</label>
                        {!!Form::text('email',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'10','disabled'])!!}
                    </div>
                    <div class="form-group col-md-6">
                      <label>Teléfono</label>
                        {!!Form::text('telefono',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'10','disabled'])!!}
                    </div>
                    <div class="form-group col-md-6">
                      <label>Filiaciones</label>
                        {!!Form::text('filiaciones',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100','disabled'])!!}
                    </div>


                    @if($autores->archivo->count() > 0)  
                    <div class="form-group col-md-12">
                       <label>Documentos</label>
                     </div>
                    @foreach ($autores->archivo as $file)
                    <div class="form-group panel panel-default col-md-12">
                      <ul>
                    <li>{{$file->tipodoc->nombre}}

                    {!!link_to_route('image.documentos', $title = 'Ver', $parameters = $file->id, $attributes = ['class'=>"btn btn-link"])!!}

                     </li>

                    </ul>
                    </div>                 

                     @endforeach
                    @endif

                       {!!Form::close()!!}
                  
             
                 <div class="col-md-12">                    
                      <a type="button" href="{{route('autor.index')}}" class="btn btn-primary fa fa-arrow-left"></a> 
                </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
               
@stop