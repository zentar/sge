
    var autor_global = [];

    function myFunction() {
    var autor = $("#autores").find('option:selected').text();
    var valor = $("#autores").val();
    console.log(autor,"-",valor);
    if(autor_global.indexOf(valor) >= 0 || valor==0 || valor=="null"){
          console.log("valor repetido, no valido o nulo");
    }else{
 //  document.getElementById('demo').innerHTML += "<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'><input class='form-control col-xs-12 col-sm-12 col-md-12 col-lg-12' maxlength='200' disabled id='autors"+valor+"' type='text' name='text[]' value='"+autor+"'></div><div class='col-xs-12 col-sm-3 col-md-2 col-lg-1'><button type='button' class='btn btn-danger fa fa-minus col-xs-2 col-sm-12 col-md-12 col-lg-6' id='autor-"+valor+"' onclick='myFunction2("+valor+")'></button></div>";
   document.getElementById('demo').innerHTML += "<div class='row col-md-12'><div class='col-xs-8 col-md-9'><input class='form-control' maxlength='200' disabled id='autors"+valor+"' type='text' name='text[]' value='"+autor+"'></div><div class='col-xs-4 col-md-3'><button type='button' class=' btn btn-danger fa fa-minus' id='autor-"+valor+"' onclick='myFunction2("+valor+")'></button></div></div>";
   document.getElementById('demo2').innerHTML += "<li id='autors"+valor+"2' type='text' name='text[]' value='"+autor+"2'>"+autor+"</li>";

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

    input_autor2 = document.getElementById("autors"+id+"2"); 
    if (!input_autor2){
        console.log("El elemento selecionado no existe");
    } else {       
        padre_input = input_autor2.parentNode;   
        padre_input.removeChild(input_autor2);   
    }

   }

   function buscar_array(array,elemento){
      var tamano = array.length;
      console.log(array);
      for(var i=0;i<tamano;i++){
         if(array[i]==elemento)
            return i;
      }
         return "-1"; 
   }

    $("#crear_libro").submit( function(eventObj) {
      var tamano = autor_global.length;
      for(var i=0;i<tamano;i++){
      $('<input />').attr('type', 'hidden')
          .attr('name', "autor[]")
          .attr('value', autor_global[i])
          .appendTo('#crear_libro');
        }
      console.log(autor_global);
      return true;
  });

     $("#crear_autores").submit( function(eventObj) {
      var tamano = autor_global.length;
      for(var i=0;i<tamano;i++){
      $('<input />').attr('type', 'hidden')
          .attr('name', "autor[]")
          .attr('value', autor_global[i])
          .appendTo('#crear_autores');
        }

       $('<input />').attr('type', 'hidden')
          .attr('name', "editar")
          .attr('value', 1)
          .appendTo('#crear_autores'); 
          
      console.log(autor_global);
      return true;
  });


    $("#crear_capitulos_libro").submit( function(eventObj) {
      var tamano = autor_global.length;

        $('<input />').attr('type', 'hidden')
          .attr('name', "autor[]")
          .attr('value', null)
          .appendTo('#crear_capitulos_libro');

      for(var i=0;i<tamano;i++){
      $('<input />').attr('type', 'hidden')
          .attr('name', "autor[]")
          .attr('value', autor_global[i])
          .appendTo('#crear_capitulos_libro');
        }
      console.log(autor_global);
      return true;
  });

