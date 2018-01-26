@extends('layouts.app')
@section('content')

  <h1 class="page-title">@lang('quickadmin.qa_au_crear')</h1>

              <div class="box box-primary">
                <div class="box-body">
                  {!!Form::open(['route'=>'autor.store', 'method'=>'POST','files' => true])!!}

                     @if ($errors->count() > 0 and Session::get('error_code') == 5)
                      @include('general/errors')
                    @endif

                   @include('autores/create_form')
                   <div class="box-footer col-md-12">
                   <a type="button" href="{{route('autor.index')}}" class="btn btn-primary fa fa-arrow-left"></a>  
                    <button type="submit" class="btn btn-primary" tabindex="7" >Grabar</button>
                  </div>
                  {!!Form::close()!!}
                </div><!-- /.box-body -->
              </div><!-- /.box -->
               
@stop

