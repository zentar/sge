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


@if(isset($autores))    
<script>
     var capitulo_global=0;
     var autor_global=['1','1','1'];
     function agregarCapitulo(){
       //var contenido = $('input[name=titulo_capitulo]').val();
      capitulo_global = capitulo_global+1;
       var contenido = "prueba"; 
      $('#capitulos').append('<div id=id_global'+capitulo_global+' class="panel panel-default"><div class="panel-heading"><h3 class="panel-title">Nombre y descripcion del Capítulo</h3></div><div class="panel-body"><div class="form-group col-md-6"><input class="form-control" placeholder="Titulo" maxlength="200" name="titulo'+capitulo_global+'" type="text" value=""></div><div class="form-group col-md-6"><input class="form-control" placeholder="Descripcion" maxlength="200" name="descripcion'+capitulo_global+'" type="text" value=""></div><div class="form-group col-md-6"><select id="autores'+capitulo_global+'" style="width: 100%" class="form-control select2" name="autores[]"><option value="null">Seleccionar Autor </option>@foreach($autores as $autor)<option value="{{ $autor->id }}"> {{ $autor->nombre }} {{ $autor->apellido }} </option>@endforeach</select></div><div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6"><div class="form-group  col-xs-12 col-sm-6 col-md-6 col-lg-2"><button type="button" class="btn btn-primary col-sm-12 col-md-12 col-lg-12" id="Agregar_autores'+capitulo_global+'" onclick="agregar_autores_capitulos('+capitulo_global+')">Agregar</button></div><div class="form-group  col-xs-12 col-sm-6 col-md-6 col-lg-2"><button type="button" class="btn btn-danger col-sm-12 col-md-12 col-lg-12" id="nuevo_autores'+capitulo_global+' data-toggle="modal" disabled onclick="eliminar_autores_capitulos('+capitulo_global+')" data-target=".bd-example-modal-lg">Quitar</button></div></div><div id="demo'+capitulo_global+'"></div></div></div>');
          autor_global[capitulo_global]=[];
          console.log(autor_global);
    }


function agregar_autores_capitulos(id){
    var autor = $("#autores"+id).find('option:selected').text();
    var valor = $("#autores"+id).val();
    //console.log(autor,"-",valor);
    if(autor_global[id].indexOf(valor) >= 0 || valor==0 || valor=="null"){
          console.log("valor repetido o no valido");
    }else{
    document.getElementById('demo'+id).innerHTML += "<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'><input class='form-control col-xs-12 col-sm-12 col-md-12 col-lg-12' maxlength='200' disabled id='autors_capitulo"+valor+id+"' type='text' name='text[]' value='"+autor+"'></div><div class='col-xs-12 col-sm-3 col-md-2 col-lg-1'><button type='button' class='btn btn-danger col-xs-2 col-sm-12 col-md-12 col-lg-12' id='autor-capitulos-"+valor+id+"' onclick='myFunction2_capitulos("+valor+","+id+")'>Quitar </button></div>";
    autor_global[id].push(valor);
    }    
    console.log(autor_global);
  }


  function myFunction2_capitulos(valor,id) {   
  console.log(autor_global);  
    var input_autor = document.getElementById("autors_capitulo"+valor+id); 
    var boton_quitar = document.getElementById("autor-capitulos-"+valor+id);
    if (!input_autor && !boton_quitar){
        console.log("El elemento selecionado no existe");
    } else {       
        padre_input = input_autor.parentNode;
        padre_btn = boton_quitar.parentNode;
        padre_input.removeChild(input_autor);
        padre_btn.removeChild(boton_quitar);
        
        var resultado = buscar_array_capitulo(autor_global[id],valor);
        autor_global[id].splice(resultado,1); 

        console.log(autor_global[id]);
         
    }
   }

   function buscar_array_capitulo(array,elemento){
      var tamano = array.length;
      console.log(array);
      for(var i=0;i<tamano;i++){
         if(array[i]==elemento)
            return i;
      }
         return "-1"; 
   }

   function eliminar_autores_capitulos(id){
     $( "#id_global"+id).remove();
        autor_global.splice(id,1); 
        console.log(autor_global,id);

   }


   $("#crear_capitulos_libro").submit( function(eventObj) {
      var tamano = capitulo_global;    
      var data = {};
      for(var i=1;i<=tamano;i++){
        var titulo = $('input[name=titulo'+i+']').val();
        var descripcion = $('input[name=descripcion'+i+']').val();
        data["capitulo"+i] = {"titulo": titulo,"descripcion":descripcion,"autores":autor_global[i]};
      }
         
      $('<input />').attr('type', 'hidden')
          .attr('name', "data")
          .attr('value', JSON.stringify(data))
          .appendTo('#crear_capitulos_libro');
     
      return true;
  });


</script>
@endif

@yield('javascript')

@yield('especial')

