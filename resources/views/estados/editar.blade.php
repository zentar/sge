@extends('layouts.app')
@section('content')
           <h1 class="page-title">@lang('quickadmin.qa_es_actualizar')</h1>
              <div class="box container col-md-6 ">
               <div class="box-body">

                  {!!Form::model($estados,['route'=> ['estados.update',$estados->id],'method'=>'POST'])!!}
                
                    @include('estados/editar_form')
                     <div class="box-footer col-md-12">
                    <button type="submit" class="btn btn-primary">Grabar</button>
                  </div>                    
                  {!!Form::close()!!}                        
                <!--  {!! link_to_route('admin.home', $title = 'Regresar',$parameters =[],$attributes = ['class'=>"btn btn-primary"] ) !!}</p> -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
@stop