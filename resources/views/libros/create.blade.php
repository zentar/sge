@extends('layouts.app')
@section('content')
             <h1 class="page-title">@lang('quickadmin.qa_li_crear')</h1>
              <div class="box box-primary">
                <div class="box-body">
              {!!Form::open(['route'=>'libro.store', 'method'=>'POST', 'id'=>"crear_libro",'name'=>"crear_libro"])!!}

          @if ($errors->count() > 0 and Session::get('error_code') == 4)
                        <div class="alert alert-danger">
                            <ul class="list-unstyled">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
              
                   @include('libros/create_form')
                   <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Grabar</button>
                  </div>
              {!!Form::close()!!}
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              
   {{--MODAL AGREGAR AUTOR--}}
   <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal_autor">
   <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" 
          data-dismiss="modal" 
          aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="favoritesModalLabel">Agregar Autor</h4>
      </div>

      <div class="modal-body">
           <div class="box box-primary">
                <div class="box-body">
                  
                 {!!Form::open(['route'=>'autor.store', 'method'=>'POST', 'id'=>"crear_autores",'name'=>"crear_autores"])!!} 
      
               @if ($errors->count() > 0 and Session::get('error_code') == 5)
                        <div class="alert alert-danger">
                            <ul class="list-unstyled">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-group">                     
                      <label>Cedula</label> 
                       {!!Form::text('cedula',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100'])!!} 
                    </div>
                    <div class="form-group">
                      <label>Nombre</label>
                      {!!Form::text('nombre',null,['class'=>'form-control', 
                      'placeholder'=>'-','maxlength'=>'100'])!!}
                    </div>
                    <div class="form-group">
                      <label>Apellido</label>
                       {!!Form::text('apellido',null,['class'=>'form-control', 
                      'placeholder'=>'-','maxlength'=>'100'])!!}
                    </div>
                    <div class="form-group">
                      <label>Email</label>
                        {!!Form::text('email',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100'])!!}
                    </div>
                    <div class="form-group">
                      <label>Teléfono</label>
                        {!!Form::text('telefono',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'10'])!!}
                    </div>
                    <div class="form-group">
                      <label>Filiaciones</label>
                        {!!Form::text('filiacion',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100'])!!}
                    </div>
                     <div class="form-group">
                      <label>Documentos</label>
                        {!!Form::text('documentos',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100'])!!}
                    </div>                 
                </div><!-- /.box-body -->
              </div><!-- /.box -->
           </div>
           <div class="modal-footer">
           <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
           <span class="pull-right">
           <button type="submit" class="btn btn-primary">Grabar</button>        
              {!!Form::close()!!}
        </span>
      </div>
    </div>
   </div>    
</div> 
@stop


@section('especial')

<script>
       @if (count(old('autor'))>0)                        
       @foreach (old('autor') as $user) 
        autor_global.push("{{$user}}");                  
       @endforeach
       @endif

       @if ($errors->count() > 0 and Session::get('error_code') == 5)
       $(function() {
           $('#modal_autor').modal('show');
       });
       @endif

</script>
@stop