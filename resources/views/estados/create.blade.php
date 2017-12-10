@extends('layouts.app')
@section('content')
             <h1 class="page-title">@lang('quickadmin.qa_es_create')</h1>
              <div class="box box-primary">
                <div class="box-body">
              {!!Form::open(['route'=>'estados.store', 'method'=>'POST', 'id'=>"crear_estado",'name'=>"crear_estado"])!!}
              
                   @include('estados/create_form')
                   <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Grabar</button>
                  </div>
              {!!Form::close()!!}
                </div><!-- /.box-body -->
              </div><!-- /.box -->
@stop
