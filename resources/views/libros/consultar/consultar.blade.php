@extends('layouts.app')
@section('content')
           <h1 class="page-title">@lang('quickadmin.qa_li_actualizar')</h1>
              <div class="box container">
               <div class="box-body">

                  {!!Form::model($libro,['route'=> ['libro.update',$libro->id],'method'=>'POST','id'=>"editar_autores",'name'=>"editar_autores"])!!}
                
                    @include('libros/consultar/consultar_form2')
                 <div class="box-footer col-md-12">
                    <a type="button" href="{{route('libro.index')}}" class="btn btn-primary fa fa-arrow-left"></a>
                  </div>                  
                  {!!Form::close()!!}                        
                <!--  {!! link_to_route('admin.home', $title = 'Regresar',$parameters =[],$attributes = ['class'=>"btn btn-primary"] ) !!}</p> -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              @include('general/autor_modal')
@stop
