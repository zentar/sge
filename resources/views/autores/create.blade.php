@extends('layouts.app')
@section('content')

  <h1 class="page-title">@lang('quickadmin.qa_au_crear')</h1>

              <div class="box box-primary">
                <div class="box-body">
                  {!!Form::open(['route'=>'autor.store', 'method'=>'POST'])!!}
                   @include('autores/create_form')
                   <div class="box-footer col-md-12">

                    <button type="submit" class="btn btn-primary">Grabar</button>
                  </div>
                  {!!Form::close()!!}
                </div><!-- /.box-body -->
              </div><!-- /.box -->
               
@stop