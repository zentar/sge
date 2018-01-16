@extends('layouts.app')
@section('content')
<h1 class="page-title">Reportes</h1>
<div class="box">
   <div class="box-body">
   <h3 class="page-title">Reporte Libro General</h3>

   {!!Form::open(['route'=>'reportes.create_general','method'=>'POST','id'=>"crear_reporte_general_libro",'name'=>"crear_reporte_general_libro"])!!}

      <div class="col-md-12">
            
         <div class="col-md-6">
         <label>Tipo de reporte:</label>
            <select id="tipo_id" style="width: 100%" class="form-control" name="tipo_id">
               <option value=null> Seleccionar Tipo </option>
               <option value="xlsx">EXCEL</option>
               <option value="pdf">PDF</option>
            </select>
         </div>

         <div class="col-md-6">
         <label>Estados:</label>
            <select id="estado_id" style="width: 100%" class="form-control select2" name="estado_id">
               <option value=null> Seleccionar Estado </option>
               @foreach($estados as $estado)
               <option value="{{ $estado->id }}">{{$estado->nombre}}</option>
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
                   <button type="submit" class="btn btn-primary">Generar</button>
                  </div> 
                          {!!Form::close()!!}      
   </div>

</div>

<div class="box">
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

        <div class="col-md-6">
         <label>Tipo de reporte:</label>
            <select id="tipo_id" style="width: 100%" class="form-control" name="tipo_id">
               <option value=null> Seleccionar Tipo </option>
               <option value="xlsx">EXCEL</option>
               <option value="pdf">PDF</option>
            </select>
         </div>

      <div class="box-footer col-md-12">
                    <button type="submit" class="btn btn-primary">Generar</button>
                  </div> 
                     {!!Form::close()!!}
   </div>
   </div>
@endsection



@section('especial')
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
@endsection





