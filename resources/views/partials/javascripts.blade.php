<script>
    window.deleteButtonTrans = '{{ trans("quickadmin.qa_delete_selected") }}';
    window.copyButtonTrans = '{{ trans("quickadmin.qa_copy") }}';
    window.csvButtonTrans = '{{ trans("quickadmin.qa_csv") }}';
    window.excelButtonTrans = '{{ trans("quickadmin.qa_excel") }}';
    window.pdfButtonTrans = '{{ trans("quickadmin.qa_pdf") }}';
    window.printButtonTrans = '{{ trans("quickadmin.qa_print") }}';
    window.colvisButtonTrans = '{{ trans("quickadmin.qa_colvis") }}';
</script>

<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="//cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>

<script src="{{ url('js') }}/tables.js"></script>
<script src="{{ url('js') }}/agregar_autores.js"></script>
<script src="{{ url('js') }}/agregar_capitulos.js"></script>
<script src="{{ url('js') }}/agregar_libros.js"></script>

<script src="{{ url('adminlte/js') }}/bootstrap.min.js"></script>
<script src="{{ url('adminlte/js') }}/select2.full.min.js"></script>
<script src="{{ url('adminlte/js') }}/main.js"></script>
<script src="{{ url('adminlte/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/fastclick/fastclick.js') }}"></script>
<script src="{{ url('adminlte/js/app.min.js') }}"></script>

<script>
    window._token = '{{ csrf_token() }}';
</script>
<script>
    $.extend(true, $.fn.dataTable.defaults, {
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        }
    });
</script>



<script>
//IMAGENES DE DOCUMENTOS EN MODAL 
function documentos_modal(id,extension,nombre){    
    var getUrl = window.location;
   // var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
    var baseUrl = getUrl .protocol + "//" + getUrl.host;

    if(extension == 'jpeg' || extension == 'png' || extension == 'bmp' || extension == 'jpg'){
   //   var src = baseUrl+"/public/image/"+id+"/documento";
      var src = baseUrl+"/image/"+id+"/documento";
      $('#doc_modal_title').text(nombre);
      document.getElementById('doc_modal').innerHTML ="<img id='imagen_doc' src='"+src+"' alt='imagen' style='display:block;margin-left: auto; margin-right: auto; max-width:870px; max-height:650px;'>"; 
      }

      if(extension == 'pdf'){
     //  var src = baseUrl+"/public/image/"+id+"/documento";
      var src = baseUrl+"/image/"+id+"/documento";
      $('#doc_modal_title').text(nombre);
      document.getElementById('doc_modal').innerHTML ="<div style='text-align: center;'><iframe src='"+src+"' style='width:100%; height:500px;' frameborder='0'></iframe></div>"; 
      }  
}
</script>

@yield('javascript')

@yield('especial')

<script>
    function editar_capitulo(id,titulo,descripcion,autor){
       document.getElementById('titulo').value = titulo;
       document.getElementById('descripcion').value = descripcion;
       $('#demo').empty();
       autor_global = [];

        for (var i = 0, len = autor.length; i < len; i++) {
              document.getElementById('demo').innerHTML += "<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'><input class='form-control col-xs-12 col-sm-12 col-md-12 col-lg-12' maxlength='200' disabled id='autors"+autor[i].id+"' type='text' name='text[]' value='"+autor[i].nombre+" "+autor[i].apellido+"'></div><div class='col-xs-12 col-sm-3 col-md-2 col-lg-1'><button type='button' class='btn btn-danger col-xs-2 col-sm-12 col-md-12 col-lg-12' id='autor-"+autor[i].id+"' onclick='myFunction2("+autor[i].id+")'>Quitar </button></div>";
              autor_global.push(autor[i].id);
        }

         $('<input />').attr('type', 'hidden')
          .attr('name', "capitulo_edit")
          .attr('value', id)
          .appendTo('#crear_capitulos_libro');
    }

    function nuevoCapitulo(){
       document.getElementById('titulo').value = "";
       document.getElementById('descripcion').value = "";
       document.getElementById('demo').innerHTML ="";   
       autor_global=[];

       $('<input />').attr('type', 'hidden')
          .attr('name', "capitulo_edit")
          .attr('value', null)
          .appendTo('#crear_capitulos_libro');

    }
</script>


<script>
    function editar_cotizacion(id,file_id,imprenta,tiraje,valor,iva){
       document.getElementById('imprenta').value = imprenta;
       document.getElementById('tiraje').value = tiraje;
       document.getElementById('valor').value = valor;

       if(iva==1)
       document.getElementById('iva').checked = true;
       else
       document.getElementById('iva').checked = false;
       
       $("#documento").val('');

         $('<input />').attr('type', 'hidden')
          .attr('name', "cotizacion_edit")
          .attr('value', id)
          .appendTo('#crear_libro_cotizacion');

          $('<input />').attr('type', 'hidden')
          .attr('name', "file_id")
          .attr('value', file_id)
          .appendTo('#crear_libro_cotizacion');

        $('#modal_cot_libro').modal("show");  
    }

    function nuevoCotizacion(){
       document.getElementById('imprenta').value = "";
       document.getElementById('tiraje').value = "";
       document.getElementById('valor').value = "";
       document.getElementById('iva').checked = false;

       $("#documento").val('');

       $('<input />').attr('type', 'hidden')
          .attr('name', "cotizacion_edit")
          .attr('value', 0)
          .appendTo('#crear_libro_cotizacion');  
    }

       $('<input />').attr('type', 'hidden')
          .attr('name', "cotizacion_edit")
          .attr('value', 0)
          .appendTo('#crear_libro_cotizacion'); 
</script>

