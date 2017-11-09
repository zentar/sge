@extends('layouts.app')
@section('content')
              <div class="box container col-md-6 ">
               <div class="box-body">

                  {!!Form::model($autor,['route'=> ['autor.update',$autor->id],'method'=>'POST'])!!}
                
                    @include('autores/editar_form')
                     <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Grabar</button>
                  </div>                    
                  {!!Form::close()!!}                        
                <!--  {!! link_to_route('admin.home', $title = 'Regresar',$parameters =[],$attributes = ['class'=>"btn btn-primary"] ) !!}</p> -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
@stop