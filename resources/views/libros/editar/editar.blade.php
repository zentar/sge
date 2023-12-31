@extends('layouts.app')
@section('content')
           <h1 class="page-title">@lang('quickadmin.qa_li_actualizar')</h1>
              <div class="box container">
               <div class="box-body">

                  {!!Form::model($libro,['route'=> ['libro.update',$libro->id],'method'=>'POST','files'=>'true','id'=>"editar_libro",'name'=>"editar_libro"])!!}
                
                    @include('libros/editar/editar_form2')
               
                  {!!Form::close()!!}                        
          
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              @include('general/modal_doc_libro')
              @include('general/autor_modal')
              @include('general/modal_cot_libro')
              @include('general/modal_aprob_cot_libro')
              @include('general/modal_autor_libro')
              @include('general/edicion_mensajes_modal')
              
              @include('general/documento_modal')
              
@stop


@section('especial')
<script>
if({{$flag_editar_autor}}==1){
       @foreach ($libro->autor as $name)
       autor_global.push("{{$name->id}}");
       @endforeach      
    }

  $("#editar_libro").submit( function(eventObj) {
      var tamano = autor_global.length;
      for(var i=0;i<tamano;i++){
      $('<input />').attr('type', 'hidden')
          .attr('name', "autor[]")
          .attr('value', autor_global[i])
          .appendTo('#editar_libro');
        }
      return true;
  });

     
</script>



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


<script>
function editar_mensaje(id,mensaje){
       document.getElementById('mensaje').value = mensaje;
       console.log(id,mensaje);
       $("#documento").val('');

         $('<input />').attr('type', 'hidden')
          .attr('name', "mensaje_edit")
          .attr('value', id)
          .appendTo('#crear_libro_mensaje');

        $('#edicion_mensajes_modal').modal("show");  
    }

    function nuevo_mensaje(){
      document.getElementById('mensaje').value = "";

      $("#documento").val('');

      $('<input />').attr('type', 'hidden')
         .attr('name', "mensaje_edit")
         .attr('value', 0)
         .appendTo('#crear_libro_mensaje');
  
   }

      $('<input />').attr('type', 'hidden')
         .attr('name', "mensaje_edit")
         .attr('value', 0)
         .appendTo('#crear_libro_mensaje'); 
</script>

<script>
function cargar_campo_especifico(){
  var campo_general = $( "#campo_general_id option:selected" ).val();  
  var campo_detallado = $("#campo_detallado_id");
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
   	
     $.ajax({
            type: "POST",
            url: "{{ route('campos.campo_especifico') }}",
            data: {campo_general: campo_general, tipo: "especifico"},
            success: function( msg ) { 
              console.log(msg);

              var campo_especifico = $("#campo_especifico_id");
              campo_especifico.empty();
              campo_detallado.empty();
              campo_especifico.prop( "disabled", false );
              campo_especifico.append($("<option />").val("null").text("Seleccionar Campo Específico")); 
                   $.each(msg, function(data) {                     
                   campo_especifico.append($("<option />").val(this.id).text(this.codigo+"-"+this.titulo));
                  });
           
            }
        });

}

function cargar_campo_detallado(){
  var campo_especifico = $( "#campo_especifico_id option:selected" ).val();
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
   	
     $.ajax({
            type: "POST",
            url: "{{ route('campos.campo_especifico') }}",
            data: {campo_especifico: campo_especifico, tipo: "detallado"},
            success: function( msg ) { 
              console.log(msg);

              var campo_detallado = $("#campo_detallado_id");
              campo_detallado.empty();
              campo_detallado.prop( "disabled", false );
              campo_detallado.append($("<option />").val("null").text("Seleccionar Campo Detallado")); 
                   $.each(msg, function(data) {                     
                   campo_detallado.append($("<option />").val(this.id).text(this.codigo+"-"+this.titulo));
                  });
           
            }
        });
}

</script>
@stop
