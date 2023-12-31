@extends('layouts.app')
@section('content')
             <h1 class="page-title">@lang('quickadmin.qa_li_crear')</h1>
              <div class="box-primary">
                <div class="box-body">
              {!!Form::open(['route'=>'libro.store', 'method'=>'POST', 'id'=>"crear_libro",'name'=>"crear_libro"])!!}

            @if ($errors->count() > 0 and Session::get('error_code') == 4)
                      @include('general/errors')
                    @endif
              
                   @include('libros/create/create_form2')
              
              {!!Form::close()!!}
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              @include('general/autor_modal') 
              @include('general/modal_autor_libro') 
@stop


@section('especial')

<script>
        @if (is_array(old('autor')))
          @if (count(old('autor'))>0)                        
            @foreach (old('autor') as $user) 
              autor_global.push("{{$user}}");                  
            @endforeach
          @endif
       @endif

       @if ($errors->count() > 0 and Session::get('error_code') == 5)
       $(function() {
           $('#modal_autor').modal('show');
       });
       @endif

</script>

<script>
       @if (Session::get('modal_autor') == 1)
       $(function() {
           $('#modal_agregar_autor').modal('show');
       });
       @endif
</script>
@stop