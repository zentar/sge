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

function add_autores(){
        var number = $('#select2-autores-container').find('option:selected').attr('title');
        var nombres = "";
        var nombres = nombres.concat(number.toString()).concat(";");
        console.log(nombres);  
        $('#lista_autores').append("number"); 
        $('#lista_autores').append(";"); 
}
