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
   var libro = [];
   var auto = []; 

 

   $("#crear_autores").submit( function(eventObj) {
      var tamano = autor_global.length;
      libro['titulo']         = $('input[name=titulo]').val();
        libro['facultad']       = $('input[name=facultad]').val();
        libro['revision_pares'] = $('input[name=revision_pares]').val();
        libro['contrato']       = $('input[name=contrato]').val();
        libro['isbn']           = $('input[name=isbn]').val();
        libro['pi']             = $('input[name=pi]').val();
        libro['paginas']        = $('input[name=paginas]').val();
        
    $('<input />').attr('type', 'hidden')
          .attr('name', "titulo")
          .attr('value', libro['titulo'])
          .appendTo('#crear_autores');

    $('<input />').attr('type', 'hidden')
          .attr('name', "facultad")
          .attr('value', libro['facultad'])
          .appendTo('#crear_autores');
          
    $('<input />').attr('type', 'hidden')
          .attr('name', "revision_pares")
          .attr('value', libro['revision_pares'])
          .appendTo('#crear_autores');

    $('<input />').attr('type', 'hidden')
          .attr('name', "contrato")
          .attr('value', libro['contrato'])
          .appendTo('#crear_autores');

    $('<input />').attr('type', 'hidden')
          .attr('name', "isbn")
          .attr('value', libro['isbn'])
          .appendTo('#crear_autores');
           
    $('<input />').attr('type', 'hidden')
          .attr('name', "pi")
          .attr('value', libro['pi'])
          .appendTo('#crear_autores');

    $('<input />').attr('type', 'hidden')
          .attr('name', "paginas")
          .attr('value', libro['paginas'])
          .appendTo('#crear_autores');  
     
      return true;
  });

</script>

@yield('javascript')

@yield('especial')

