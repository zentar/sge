@extends('layouts.app')
@section('content')
     <h1 class="page-title">@lang('quickadmin.qa_es_consultar')</h1>
              <div class="box container col-md-6 ">
                <div class="box-body">
                  {!!Form::model($facultades,['route'=> ['facultad.update',$facultades->id],'method'=>'PUT'])!!}
                    <div class="form-group col-md-6">
                      <label>Nombre</label>
                      {!!Form::text('nombre',null,['class'=>'form-control', 
                      'placeholder'=>'-','maxlength'=>'100','disabled'])!!}
                    </div>                                      
                  {!!Form::close()!!}
                    <div class="col-md-12">
                      {!! link_to_route('facultad.index', $title = 'Regresar',$parameters =[],$attributes = ['class'=>"btn btn-primary"] ) !!}</p>
                </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
               
@stop