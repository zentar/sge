@extends('layouts.app')
@section('content')
           <h1 class="page-title">@lang('quickadmin.qa_li_actualizar')</h1>
              <div class="box container col-md-6 ">
               <div class="box-body">

                  {!!Form::model($libro,['route'=> ['libro.update',$libro->id],'method'=>'POST','id'=>"editar_autores",'name'=>"editar_autores"])!!}
                
                    @include('libros/editar_form')
                     <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Grabar</button>
                  </div>                    
                  {!!Form::close()!!}                        
                <!--  {!! link_to_route('admin.home', $title = 'Regresar',$parameters =[],$attributes = ['class'=>"btn btn-primary"] ) !!}</p> -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
@stop


@section('especial')
<script>
if({{$flag_editar_autor}}==1){
       @foreach ($libro->autor as $name)
       autor_global.push("{{$name->id}}");
       @endforeach      
    }

  $("#editar_autores").submit( function(eventObj) {
      var tamano = autor_global.length;
      for(var i=0;i<tamano;i++){
      $('<input />').attr('type', 'hidden')
          .attr('name', "autor[]")
          .attr('value', autor_global[i])
          .appendTo('#editar_autores');
        }
      return true;
  });
     
</script>
@stop