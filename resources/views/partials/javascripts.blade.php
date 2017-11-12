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
$(document).ready(function() {
    $('.libros').DataTable({
  "columns": [
    { "width": "5%" },
    { "width": "30%" },
    { "width": "25%" },
    { "width": "15%" },
    { "width": "25%" }
  ]
} );
} );
</script>

<script>
$(document).ready(function() {
    $('.autores').DataTable({
  "columns": [
    { "width": "5%" },
    { "width": "8%" },
    { "width": "30%" },
    { "width": "25%" },
    { "width": "10%" },
    { "width": "20%" }
  ]
} );
} );
</script>

<script>
function add_autores(){
        var number = $('#select2-autores-container').find('option:selected').attr('title');
        var nombres = "";
        var nombres = nombres.concat(number.toString()).concat(";");
        console.log(nombres);  
        $('#lista_autores').append("number"); 
        $('#lista_autores').append(";"); 
}
</script>


<script>
    var autor_global = [];


    function myFunction() {
    var autor = $("#autores").find('option:selected').text();
    var valor = $("#autores").val();
    if(autor_global.indexOf(valor) >= 0){
          console.log("valor repetido");
    }else{
    document.getElementById('demo').innerHTML += "<input class='col-md-6' maxlength='200' disabled id='autors"+valor+"' type='text' name='text[]' value='"+autor+"'><button type='button' class='btn-danger col-md-1' id='autor-"+valor+"' onclick='myFunction2("+valor+")'>Quitar </button>";
    autor_global.push(valor);
    }    
    console.log(autor_global);
}

   function myFunction2(id) {    
    input_autor = document.getElementById("autors"+id); 
    boton_quitar = document.getElementById("autor-"+id);
    if (!input_autor && !boton_quitar){
        console.log("El elemento selecionado no existe");
    } else {       
        padre_input = input_autor.parentNode;
        padre_btn = boton_quitar.parentNode;
        padre_input.removeChild(input_autor);
        padre_btn.removeChild(boton_quitar);
        var resultado = buscar_array(autor_global,id);
        autor_global.splice(resultado,1);     
    }
   }

   function buscar_array(array,elemento){
      var tamano = array.length;
      for(var i=0;i<tamano;i++){
         if(array[i]==elemento)
            return i;
      }
         return "-1"; 
   }

    $("#crear_autores").submit( function(eventObj) {
      var tamano = autor_global.length;
      for(var i=0;i<tamano;i++){
      $('<input />').attr('type', 'hidden')
          .attr('name', "autor[]")
          .attr('value', autor_global[i])
          .appendTo('#crear_autores');
        }
      return true;
  });

    

</script>

@yield('javascript')

@yield('especial')