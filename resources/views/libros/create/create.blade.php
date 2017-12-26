@extends('layouts.app')
@section('content')
             <h1 class="page-title">@lang('quickadmin.qa_li_crear')</h1>
              <div class="box box-primary">
                <div class="box-body">
              {!!Form::open(['route'=>'libro.store', 'method'=>'POST', 'id'=>"crear_libro",'name'=>"crear_libro"])!!}

            @if ($errors->count() > 0 and Session::get('error_code') == 4)
                      @include('general/errors')
                    @endif
              
                   @include('libros/create/create_form2')
                   <div class="box-footer">
                   <a type="button" href="{{route('libro.index')}}" class="btn btn-primary fa fa-arrow-left"></a>
                    <button type="submit" class="btn btn-primary">Grabar</button>
                  </div>
              {!!Form::close()!!}
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              @include('general/autor_modal') 
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