
   var libro = [];
   var auto = []; 

   $("#crear_autores").submit( function(eventObj) {
      var tamano = autor_global.length;
      var e = document.getElementById("facultad_id");
      var facultad_old = e.options[e.selectedIndex].value;

        libro['titulo']         = $('input[name=titulo]').val();
        libro['facultad_old']   = facultad_old;
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
          .attr('name', "facultad_old")
          .attr('value', libro['facultad_old'])
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

    $('<input />').attr('type', 'hidden')
          .attr('name', "editar")
          .attr('value', 1)
          .appendTo('#crear_autores'); 
     
      return true;
  });

