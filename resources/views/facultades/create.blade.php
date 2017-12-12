@extends('layouts.app')
@section('content')
             <h1 class="page-title">@lang('quickadmin.qa_fa_create')</h1>
              <div class="box box-primary">
                <div class="box-body">
              {!!Form::open(['route'=>'facultad.store', 'method'=>'POST', 'id'=>"crear_facultad",'name'=>"crear_facultad"])!!}
              
                   @include('facultades/create_form')
                   <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Grabar</button>
                  </div>
              {!!Form::close()!!}
                </div><!-- /.box-body -->
              </div><!-- /.box -->
@stop
