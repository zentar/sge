@extends('layouts.app')
@section('content')
           <h1 class="page-title">@lang('quickadmin.qa_au_actualizar')</h1>
              <div class="box container col-md-6 ">
               <div class="box-body">

                  {!!Form::model($autor,['route'=> ['autor.update',$autor->id],'method'=>'POST','files' => true])!!}
                
                    @include('autores/editar_form')
                     <div class="box-footer col-md-12">
                      <a type="button" href="{{route('autor.index')}}" class="btn btn-primary fa fa-arrow-left"></a>  
                    <button type="submit" class="btn btn-primary">Grabar</button>
                  </div>                    
                  {!!Form::close()!!}                        
                <!--  {!! link_to_route('admin.home', $title = 'Regresar',$parameters =[],$attributes = ['class'=>"btn btn-primary"] ) !!}</p> -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              @include('general/documento_modal')
@stop