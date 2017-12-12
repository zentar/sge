@extends('layouts.app')
@section('content')
           <h1 class="page-title">@lang('quickadmin.qa_col_actualizar')</h1>
              <div class="box container col-md-6 ">
               <div class="box-body">

                  {!!Form::model($colecciones,['route'=> ['coleccion.update',$colecciones->id],'method'=>'POST'])!!}
                
                    @include('colecciones/editar_form')
                     <div class="box-footer col-md-12">
                    <button type="submit" class="btn btn-primary">Grabar</button>
                  </div>                    
                  {!!Form::close()!!}                        
                <!--  {!! link_to_route('admin.home', $title = 'Regresar',$parameters =[],$attributes = ['class'=>"btn btn-primary"] ) !!}</p> -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
@stop