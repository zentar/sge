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
                             
                @include('general/documento_modal')
                
  @stop
  
  
  @section('especial')
 
  
  
  <script>
  //EVALUA QUE MODAL PRESENTAR CON LOS ERRORES
         @if ($errors->count() > 0 and Session::get('error_code') == 5)
         $(function() {
             $('#modal_autor').modal('show');
         });
         @endif
  
         @if ($errors->count() > 0 and Session::get('error_code') == 6)
         $(function() {
             $('#modal_doc_libro').modal('show');
         });
         @endif
  
         @if ($errors->count() > 0 and Session::get('error_code') == 7)
         $(function() {
             $('#modal_cot_libro').modal('show');
         });
         @endif
  
         @if ($errors->count() > 0 and Session::get('error_code') == 8)
         $(function() {
             $('#modal_aprob_cot_libro').modal('show');
         });
         @endif
  
         @if ($errors->count() > 0 and Session::get('error_code') == 9)
         $(function() {
             $('#edicion_mensajes_modal').modal('show');
         });
         @endif
  
  </script>
  
  <script>
         @if (Session::get('modal_autor') == 1)
         $(function() {
             $('#modal_agregar_autor').modal('show');
         });
         @endif
  </script>
  
  <script type="text/javascript">
    //CENSA EN QUE TAB SE ENCUENTRA AL REFRESCAR LA PANTALLA
  $(document).ready(function(){
    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
      localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if(activeTab){
      $('#tab_libro a[href="' + activeTab + '"]').tab('show');
    }
  });
  </script>
  @stop
  