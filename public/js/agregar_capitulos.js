    var capitulo_global=1;
    var autor_global = [];
     function agregarCapitulo(){
       //var contenido = $('input[name=titulo_capitulo]').val();
       var contenido = "prueba"; 
      $('#capitulos').append('<div id=id_global'+capitulo_global+' class="panel panel-default"><div class="panel-heading"><h3 class="panel-title">Capítulo '+capitulo_global+'</h3></div><div class="panel-body"><div class="form-group col-md-6"><input class="form-control" placeholder="Titulo" maxlength="200" name="titulo'+capitulo_global+'" type="text" value=""></div><div class="form-group col-md-6"><input class="form-control" placeholder="Descripcion" maxlength="200" name="descripcion'+capitulo_global+'" type="text" value=""></div><div class="form-group col-md-6"><select id="autores'+capitulo_global+'" style="width: 100%" class="form-control select2" name="autores'+capitulo_global+'"><option value="null">Seleccionar Autor </option>@foreach($autores as $autor)<option value="{{ $autor->id }}"> {{ $autor->nombre }} {{ $autor->apellido }} </option>@endforeach</select></div><div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6"><div class="form-group  col-xs-12 col-sm-6 col-md-6 col-lg-2"><button type="button" class="btn btn-primary col-sm-12 col-md-12 col-lg-12" id="Agregar_autores'+capitulo_global+'" onclick="agregar_autores_capitulos('+capitulo_global+')">Agregar</button></div><div class="form-group  col-xs-12 col-sm-6 col-md-6 col-lg-2"><button type="button" class="btn btn-danger col-sm-12 col-md-12 col-lg-12" id="nuevo_autores'+capitulo_global+' data-toggle="modal" data-target=".bd-example-modal-lg">Quitar</button></div></div><div id="demo'+capitulo_global+'"></div></div></div>');

       capitulo_global= capitulo_global+1;
       autor_global[capitulo_global]=[];

    }



     function agregar_autores_capitulos(id){
    var autor = $("#autores"+id).find('option:selected').text();
    var valor = $("#autores"+id).val();
    //console.log(autor,"-",valor);
    if(autor_global[id].indexOf(valor) >= 0 || valor==0){
          console.log("valor repetido o no valido");
    }else{
    document.getElementById('demo'+id).innerHTML += "<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'><input class='form-control col-xs-12 col-sm-12 col-md-12 col-lg-12' maxlength='200' disabled id='autors_capitulo"+valor+"' type='text' name='text[]' value='"+autor+"'></div><div class='col-xs-12 col-sm-3 col-md-2 col-lg-1'><button type='button' class='btn btn-danger col-xs-2 col-sm-12 col-md-12 col-lg-12' id='autor-capitulos-"+valor+"' onclick='myFunction2_capitulos("+valor+")'>Quitar </button></div>";
    autor_global[id].push(valor);
    }    
    console.log(autor_global);
  }


  function myFunction2_capitulos(id) {    
    input_autor = document.getElementById("autors_capitulo"+id); 
    boton_quitar = document.getElementById("autor-capitulos-"+id);
    if (!input_autor && !boton_quitar){
        console.log("El elemento selecionado no existe");
    } else {       
        padre_input = input_autor.parentNode;
        padre_btn = boton_quitar.parentNode;
        padre_input.removeChild(input_autor);
        padre_btn.removeChild(boton_quitar);
        var resultado = buscar_array(autor_global[id],id);
        autor_global[id].splice(resultado,1);     
    }
   }