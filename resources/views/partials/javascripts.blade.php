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
            "url": "http://cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        }
    });
</script>


<script>
     var capitulo_global=1;


    

     function agregarCapitulo(){
       var contenido = $('input[name=titulo_capitulo]').val(); 
       document.getElementById('capitulos').innerHTML +="<div class='panel panel-default'><div class='panel-heading'><h3 class='panel-title'>Capítulo "+capitulo_global+"</h3></div><div class='panel-body'><div class='form-group col-md-6'><input class='form-control' placeholder='Ingrese capitulo' disabled maxlength='200' name='capitulo' type='text' value="+contenido+"></div><div class='form-group col-xs-12 col-sm-12 col-md-6 col-lg-6'><div class='form-group  col-xs-12 col-sm-6 col-md-6 col-lg-2'><button type='button' class='btn btn-primary col-sm-12 col-md-12 col-lg-12' id='Agregar_autores' onclick='myFunction()'>Agregar</button></div><div class='form-group  col-xs-12 col-sm-6 col-md-6 col-lg-2'><button type='button' class='btn btn-primary col-sm-12 col-md-12 col-lg-12' id='nuevo_autores' onclick='myFunction()'>Quitar</button></div></div></div></div><div id='autores_capitulo"+capitulo_global+"'></div>";  

 
       capitulo_global= capitulo_global+1;
    }
    </script>

@yield('javascript')

@yield('especial')

