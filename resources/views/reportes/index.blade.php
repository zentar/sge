@extends('layouts.app')
@section('content')
<h1 class="page-title">Reportes</h1>

<div class="box">
   <div class="box-body">
   <div class="col-md-6">
         <label>Tipo de reporte:</label>
            <select id="tipo_reporte" style="width: 100%" class="form-control" name="tipo_reporte" onchange="mostrar_reportes()">
               <option value=null> Seleccionar Tipo </option>
               <option value="gen">Reporte General</option>
               <option value="esp">Reporte Especifico</option>
            </select>
         </div>

   </div>
   </div>

<div class="box" id="reporte_general" name="reporte_general" style="display:none;">
   <div class="box-body">
   <h3 class="page-title">Reporte Libro General</h3>

   {!!Form::open(['route'=>'reportes.create_general','method'=>'POST','id'=>"crear_reporte_general_libro",'name'=>"crear_reporte_general_libro"])!!}

      <div class="col-md-12">

        <div class="col-md-6">
         <label>Estados:</label>
            <select id="estado_id" style="width: 100%" class="form-control select2" name="estado_id">
               <option value=null> Seleccionar Estado </option>
               @foreach($estados as $estado)
               <option value="{{ $estado->id }}">{{$estado->nombre}}</option>
               @endforeach
            </select>
         </div>

      

         <div class="col-md-6">
         <label>Colecciones:</label>
            <select id="coleccion_id" style="width: 100%" class="form-control select2" name="coleccion_id">
               <option value=null> Seleccionar Colección </option>
               @foreach($colecciones as $coleccion)
               <option value="{{ $coleccion->id }}">{{$coleccion->titulo}}</option>
               @endforeach
            </select>
         </div>

         </div>  

         <div class="col-md-12">
         <div class="col-md-6">
            <label>Fecha Desde:</label> <input class="form-control" readonly="readonly" type="text" id="datepicker_desde" name="desde">
         </div>
         <div class="col-md-6">
            <label>Fecha Hasta:</label> <input class="form-control" readonly="readonly" type="text" id="datepicker_hasta" name="hasta">
         </div>
         </div>

         <div class="box-footer col-md-12">
                   <button type="submit" id="general_pdf" name="general_pdf" onclick="agregar_a_post('general','pdf')" class="btn btn-danger fa fa-file-pdf-o ">PDF</button>
                   <button type="submit" id="general_excel" name="general_excel" onclick="agregar_a_post('general','xlsx')"  class="btn btn-success fa fa-file-excel-o">Excel</button>
                  </div> 
                          {!!Form::close()!!}      
   </div>

   <div class="col-md-9 col-sm-12 col-xs-12 col-lg-9">
           <canvas id="myChart" style="margin-left:15%;"></canvas>   
   </div>
</div>

<div class="box" id="reporte_especifico" name="reporte_especifico" style="display:none;">
   <div class="box-body">
   <h3 class="page-title">Reporte Libro Específico</h3>

         {!!Form::open(['route'=>'reportes.create','method'=>'POST','id'=>"crear_reporte_libro",'name'=>"crear_reporte_libro"])!!}

   <div class="col-md-6">
         <label>Libro:</label>
            <select id="libro_id" style="width: 100%" class="form-control select2" name="libro_id">
               <option value=null> Seleccionar Libro </option>
               @foreach($libros as $libro)
               <option value="{{ $libro->id }}">{{$libro->titulo}}</option>
               @endforeach
            </select>
         </div>  

  

      <div class="box-footer col-md-12">         
                    <button type="submit" id="general_pdf" name="general_pdf" onclick="agregar_a_post('especifico','pdf')" class="btn btn-danger fa fa-file-pdf-o ">PDF</button>
                    <button type="submit" id="general_excel" name="general_excel" onclick="agregar_a_post('especifico','xlsx')" class="btn btn-success fa fa-file-excel-o">Excel</button>
                  
        
                  </div> 
                     {!!Form::close()!!}
   </div>

   
   </div>

  
@endsection



@section('especial')

<script>
  function mostrar_reportes(){
    var x = document.getElementById("tipo_reporte").value;
    
    if(x=='gen'){
      var x = document.getElementById("reporte_general");
      var y = document.getElementById("reporte_especifico");
      y.style.display = "none";
      x.style.display = "block";
    }

    if(x=='esp'){
      var x = document.getElementById("reporte_general");
      var y = document.getElementById("reporte_especifico");
      x.style.display = "none";
      y.style.display = "block";
    }

    if(x=='null'){
      var x = document.getElementById("reporte_general");
      var y = document.getElementById("reporte_especifico");
      x.style.display = "none";
      y.style.display = "none";
    }
  }
  var extension = "";

  function agregar_a_post(tipo_reporte,ext){
    extension = ext; 
  }

      $("#crear_reporte_general_libro").submit( function(eventObj) {

      $('<input />').attr('type', 'hidden')
          .attr('name', "tipo_id")
          .attr('value', extension)
          .appendTo('#crear_reporte_general_libro');
      return true;
  });

      $("#crear_reporte_libro").submit( function(eventObj) {
        $('<input />').attr('type', 'hidden')
            .attr('name', "tipo_id")
            .attr('value', extension)
            .appendTo('#crear_reporte_libro');
        return true;
    });  
</script>

<script>
$(document).ready(function() {
  $( function() {
    $( "#datepicker_desde" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: "yy-mm-dd",
      maxDate: "+1",
      minDate: "-2y",
      defaultDate: -1
    });
  } );

  $( function() {
    $( "#datepicker_hasta" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: "yy-mm-dd",
      maxDate: "+1",
      minDate: "-2y",
       defaultDate: +1
    });
  } );

  $.datepicker.regional['es'] = {
    closeText: 'Cerrar',
    prevText: '<Ant',
    nextText: 'Sig>',
    currentText: 'Hoy',
    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
    dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
    weekHeader: 'Sm',
    dateFormat: 'dd/mm/yy',
    firstDay: 1,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: ''
  };
  $.datepicker.setDefaults($.datepicker.regional['es']);
});

  </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.min.js"> </script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"> </script>

<script>
var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, { 
 // type: 'horizontalBar',
  type: 'bar',  
  data: {
    labels: ["Ingresado", "Aprobado", "Edición", "Cotización", "Aprobado Cotización", "Producción","Publicado"],
    datasets: [{
      label: 'Ingresado',
      backgroundColor: "rgba(255,153,0,0.4)",
      data: [{!! $grafico_data[1] !!}],
      fill:false,
      datalabels:{
        anchor:'center',
        align:'top',
        color:"rgba(0,0,0,1)",
        font:{
          size: 17,
          style:"bold",
        
        }
      },
    }, {
      label: 'Aprobado',
      backgroundColor: "rgba(39,165,161,1)",
      data: [{!! $grafico_data[2] !!}],
      fill:false,
      datalabels:{
        anchor:'center',
        align:'top',
         color:"rgba(0,0,0,1)",
        font:{
          size: 17,
          style:"bold",
        }
      },
    }, {
      label: 'Edición',
      backgroundColor: "rgba(30, 30, 102,0.72)",
      data: [{!! $grafico_data[3] !!}],
      fill:false,
      datalabels:{
        anchor:'center',
        align:'top',
         color:"rgba(0,0,0,1)",
        font:{
          size: 17,
          style:"bold",
        }
      },
    },{
      label: 'Cotización',
      backgroundColor: "rgba(253,163,0,0.7)",
      data:[{!! $grafico_data[4] !!}],
      fill:false,
      datalabels:{
        anchor:'center',
        align:'top',
         color:"rgba(0,0,0,1)",
        font:{
          size: 17,
          style:"bold",
        }
      },
    }, {
      label: 'Aprobado Cotización',
      backgroundColor: "rgba(0,255,0,0.3)",
      data:[{!! $grafico_data[5] !!}],
      fill:false,
      datalabels:{
        anchor:'center',
        align:'top',
         color:"rgba(0,0,0,1)",
        font:{
          size: 17,
          style:"bold",
        }
      },
    }, {
      label: 'Producción',
      backgroundColor: "rgba(205, 29, 29,0.7)",
      data:[{!! $grafico_data[6] !!}],
      fill:false,
      datalabels:{
        anchor:'center',
        align:'top',
         color:"rgba(0,0,0,1)",
        font:{
          size: 17,
          style:"bold",
        }
      },
    },{
      label: 'Publicado',
      backgroundColor: "rgba(164, 29, 205,0.5)",
      data:[{!! $grafico_data[7] !!}],
      fill:false,
      datalabels:{
        anchor:'center',
        align:'top',
         color:"rgba(0,0,0,1)",
        font:{
          size: 17,
          style:"bold",
        }
      },
    }]
  },

  options: {
  // legendCallback: function(chart) {},
    responsive: true,
    animation: {
            "duration": 0,
    },  
    title: {
         display: true,
         text: 'Cantidad de Libros por estado',
       },

    legend: {
      display: true,
      position: 'top',
      labels: {
        fontColor: "#000080",

      },
      
  /*   DESHABILITA OPCION DE CLICK EN LEGENDA DE LA IMAGEN  
  
     onClick: function (e) {
        console.log(e);
        e.stopPropagation();
    },*/


    },
    scales: {
      xAxes: [{
   
          stacked: false,
          beginAtZero: true,
          ticks: {
              min: 0,
              autoSkip: false
          },
          position: 'bottom',
        
           scaleLabel: {
             display: true,
             labelString: 'Estados'
           },
           categoryPercentage: 1.0,
           barPercentage: 0.6,
      }],
      yAxes: [{
     
          stacked: false,
          beginAtZero: true,
          ticks: {
            min: 0,
            beginAtZero: true
          },
          position: 'left',
         
           scaleLabel: {
             display: true,
             labelString: 'Cantidad de Libros'
           },
           categoryPercentage: 1.0,
           barPercentage: 0.6,
      }]
  },
  
 
 /* hover: {
          mode: 'label',
          intersect: true
  },*/
  tooltips:{
         // mode:'label',
         // intersect:false,
          callbacks: {
         title: function() {}
      },
  },
  }
  
});

</script>
@endsection





