$(document).ready(function() {
    $('.libros').DataTable({
      //  dom: 'lBfrtip<"actions">',
         "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
  "columns": [
    { "width": "5%" },
    { "width": "30%" },
    { "width": "25%" },
    { "width": "15%" },
    { "width": "25%" }
  ],
   buttons: [
            {
                extend: 'copy',
                text: window.copyButtonTrans,
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'csv',
                text: window.csvButtonTrans,
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'excel',
                text: window.excelButtonTrans,
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdf',
                text: window.pdfButtonTrans,
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'print',
                text: window.printButtonTrans,
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'colvis',
                text: window.colvisButtonTrans,
                exportOptions: {
                    columns: ':visible'
                }
            },
        ]
} );
} );

$(document).ready(function() {
    $('.autores').DataTable({
      //   dom: 'lBfrtip<"actions">',
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
  "columns": [
    { "width": "5%" },
    { "width": "8%" },
    { "width": "30%" },
    { "width": "25%" },
    { "width": "10%" },
    { "width": "20%" }
  ],
     buttons: [
            {
                extend: 'copy',
                text: window.copyButtonTrans,
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'csv',
                text: window.csvButtonTrans,
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'excel',
                text: window.excelButtonTrans,
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdf',
                text: window.pdfButtonTrans,
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'print',
                text: window.printButtonTrans,
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'colvis',
                text: window.colvisButtonTrans,
                exportOptions: {
                    columns: ':visible'
                }
            },
        ]
} );
} );

$(document).ready(function() {
   var table = $('.capitulos').DataTable({
         "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        "columnDefs": [
            {
                "targets": [ 0 ],
                "visible": false,
                "searchable": false
            }
          ],
  "columns": [
    { "width": "2%" },
    { "width": "25%" },
    { "width": "25%" },
    { "width": "40%" },
    { "width": "8%" }
  ],
} );

     $('#example1 tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    } );
     
} );

$(document).ready(function() {
     $('.estados').DataTable({
         "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        "columnDefs": [
            {
                "targets": null,
                "visible": false,
                "searchable": false
            }
          ],
  "columns": [
    { "width": "2%" },
    { "width": "38%" },
    { "width": "30%" },
    { "width": "30%" }
  ],
} );
} );

$(document).ready(function() {
     $('.facultades').DataTable({
         "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        "columnDefs": [
            {
                "targets": null,
                "visible": false,
                "searchable": false
            }
          ],
  "columns": [
    { "width": "5%" },
    { "width": "10%" },
    { "width": "10%" }
  ],
} );
} );


$(document).ready(function() {
     $('.colecciones').DataTable({
         "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        "columnDefs": [
            {
                "targets": null,
                "visible": false,
                "searchable": false
            }
          ],
  "columns": [
    { "width": "5%" },
    { "width": "20%" },
    { "width": "20%" },
    { "width": "20%" }
  ],
} );
} );


$(document).ready(function() {
     $('.fileautor').DataTable({
         "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        "columnDefs": [
            {
                "targets": null,
                "visible": false,
                "searchable": false
            }
          ],
  "columns": [
    { "width": "11%" },
    { "width": "11%" },
    { "width": "11%" },
    { "width": "11%" },
    { "width": "11%" },
    { "width": "11%" },
    { "width": "11%" },
    { "width": "11%" }
  ],
} );
} );

$(document).ready(function() {
     $('.filelibro').DataTable({
         "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        "columnDefs": [
            {
                "targets": null,
                "visible": false,
                "searchable": false
            }
          ],
  "columns": [
    { "width": "11%" },
    { "width": "11%" },
    { "width": "11%" },
    { "width": "11%" },
    { "width": "11%" },
    { "width": "11%" },
    { "width": "11%" },
    { "width": "11%" }
  ],
} );
} );

$(document).ready(function() {
     $('.cotizaciones').DataTable({
         "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        "columnDefs": [
            {
                "targets": null,
                "visible": false,
                "searchable": false
            }
          ],
  "columns": [
    { "width": "16%" },
    { "width": "16%" },
    { "width": "16%" },
    { "width": "16%" },
    { "width": "16%" },
    { "width": "16%" }
  ],
} );
} );

$(document).ready(function() {
    var table = $('.consultarCapitulo').DataTable({
        "paging":   false,
        "ordering": false,
        "info":     false,
        searching: false, paging: false,
          "language": {
             "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
         },
         "columnDefs": [
             {
                 "targets": [ 0 ],
                 "visible": false,
                 "searchable": false
             }
           ],
   "columns": [
     { "width": "2%" },
     { "width": "25%" },
     { "width": "25%" },
     { "width": "40%" }
   ],
 } );
} );


$(document).ready(function() {
    var table = $('.consultarCotizacion').DataTable({
        "paging":   false,
        "ordering": false,
        "info":     false,
        searching: false, paging: false,
          "language": {
             "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
         },
        
   "columns": [
    { "width": "16%" },
    { "width": "16%" },
    { "width": "16%" },
    { "width": "16%" },
    { "width": "16%" },
    { "width": "16%" }
   ],
 } );
} );

$(document).ready(function() {
    var table = $('.roles').DataTable({
          "language": {
             "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
         },
        
   "columns": [
    { "width": "50%" },
    { "width": "50%" }
    ]
 } );
} );

$(document).ready(function() {
    var table = $('.usuarios').DataTable({
          "language": {
             "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
         },
        
   "columns": [
    { "width": "25%" },
    { "width": "25%" },
    { "width": "25%" },
    { "width": "25%" }
    ]
 } );
} );

// TABLES DE ROLES Y USUARIOS EN ADMINLTE/JS/MAIN.JS

function add_autores(){
        var number = $('#select2-autores-container').find('option:selected').attr('title');
        var nombres = "";
        var nombres = nombres.concat(number.toString()).concat(";");
        console.log(nombres);  
        $('#lista_autores').append("number"); 
        $('#lista_autores').append(";"); 
}
