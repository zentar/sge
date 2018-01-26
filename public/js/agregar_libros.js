
   var libro = [];
   var auto = []; 

   $("#crear_autores").submit( function(eventObj) {
      var tamano = autor_global.length;
      var e = document.getElementById("facultad_id");
      var facultad_old = e.options[e.selectedIndex].value;

      var f = document.getElementById("coleccion_id");
      var coleccion_old = e.options[e.selectedIndex].value;

        libro['titulo']         = $('input[name=titulo]').val();
        libro['facultad_old']   = facultad_old;
        libro['coleccion_old']   = coleccion_old;
        
    $('<input />').attr('type', 'hidden')
          .attr('name', "titulo")
          .attr('value', libro['titulo'])
          .appendTo('#crear_autores');

    $('<input />').attr('type', 'hidden')
          .attr('name', "facultad_old")
          .attr('value', libro['facultad_old'])
          .appendTo('#crear_autores');

          $('<input />').attr('type', 'hidden')
          .attr('name', "coleccion_old")
          .attr('value', libro['coleccion_old'])
          .appendTo('#crear_autores');

    $('<input />').attr('type', 'hidden')
          .attr('name', "editar")
          .attr('value', 1)
          .appendTo('#crear_autores'); 
     
      return true;
  });

