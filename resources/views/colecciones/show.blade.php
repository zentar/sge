@extends('layouts.app')
@section('content')
     <h1 class="page-title">@lang('quickadmin.qa_col_consultar')</h1>
              <div class="box container col-md-6 ">
                <div class="box-body">
                  {!!Form::model($colecciones,['route'=> ['coleccion.update',$colecciones->id],'method'=>'PUT'])!!}
                    <div class="form-group col-md-6">
                      <label>Título</label>
                      {!!Form::text('titulo',null,['class'=>'form-control', 
                      'placeholder'=>'-','maxlength'=>'100','disabled'])!!}
                    </div> 

                    <div class="form-group col-md-6">
                    <label>Descripción</label>
                      {!!Form::text('descripcion',null,['class'=>'form-control', 
                      'placeholder'=>'-','maxlength'=>'100','disabled'])!!}
                    </div>                                     
                  {!!Form::close()!!}
                    <div class="col-md-12">
                      {!! link_to_route('coleccion.index', $title = 'Regresar',$parameters =[],$attributes = ['class'=>"btn btn-primary"] ) !!}</p>
                </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
               
@stop