@extends('layouts.app')
@section('content')
<h1 class="page-title">Características</h1>
 <div class="box">
   <div class="box-body">
   <div class="col-md-6">
         <label>Tipo de reporte:</label>
            <select id="tipo_caracteristica" style="width: 100%" class="form-control" name="tipo_caracteristica" onchange="mostrar_caracteristicas()">
               <option value=null @if(Session::get('old_caracteristica') == null) selected @endif > Seleccionar Caracteristica</option>
               <option value="tipopapel" @if(Session::get('old_caracteristica') == "tipopapel") selected @endif >Tipo papel</option>
               <option value="tamanopapel" @if(Session::get('old_caracteristica') == "tamanopapel") selected @endif >Tamaño de papel</option>
               <option value="colorpapel" @if(Session::get('old_caracteristica') == "colorpapel") selected @endif >Color</option>
            </select>
         </div>
   </div>
   </div>


<div  id="tipo_papel" style="display:none;">
  <div class="col-md-12">
 <button type="button" class="btn btn-success fa fa-plus" id="modal_tipopapel" data-toggle="modal" data-target="#tipo_papel_modal_crear" onclick="nuevo_tipopapel()"> Nuevo</button>
</div>
<div class="panel-body col-md-12">
            <table id="example1" class="table table-striped table-bordered display compact caracteristicas" cellspacing="0" width="100%">
        <thead>
             <tr> 
                    <th class="dt-head-center"></th>
                <th class="dt-head-center"></th>                  
                <th class="dt-head-center">ID</th>
                <th class="dt-head-center">Descripción</th>
           
            </tr>
        </thead>
        <tfoot>
            <tr> 
                <th class="dt-head-center"></th> 
            <th class="dt-head-center"></th>                
            <th class="dt-head-center">ID</th>
            <th class="dt-head-center">Descripción</th>
                 
            </tr>
        </tfoot>
        <tbody>
           @foreach($tipo_papel as $tipo)
           <tr>
           <td  width="4%" style="vertical-align: middle;" class="dt-body-left"> 
                 <p>
                <button type="button" href="" class="btn btn-warning btn-md fa fa-pencil-square-o" onclick="editar_tipopapel('{{$tipo->id}}','{{$tipo->descripcion}}')"></button>
                </p>
                </td>

                <td  width="4%" style="vertical-align: middle;" class="dt-body-left"> 
                 <p>    
                {!!link_to_route('caracteristicas.destroytipopapel', $title = '', $parameters = [$tipo->id], $attributes = ['class'=>"btn btn-danger fa fa-trash-o",'onclick'=>'return confirm("Esta seguro de borrar este registro?")'])!!} 
             

               </p>
                </td>
           <td  width="4%" style="vertical-align: middle;" class="dt-body-left">{{$tipo->id}}</td>
           <td  width="88%" style="vertical-align: middle;" class="dt-body-left">{{$tipo->descripcion}}</td>
           
          
           </tr>
           @endforeach     
        </tbody>
    </table>
    </div>
</div>

<div  id="tamano_papel" style="display:none;" >
  <div class="col-md-12">

  <button type="button" class="btn btn-success fa fa-plus" id="modal_tamanopapel" data-toggle="modal" data-target="#tamano_papel_modal_crear" onclick="nuevo_tamanopapel()"> Nuevo</button>
</div>
    <div class="panel-body col-md-12">
            <table id="example1" class="table table-striped table-bordered display compact caracteristicas" cellspacing="0" width="100%">
        <thead>
             <tr>   
             <th class="dt-head-center"></th>
                 <th class="dt-head-center"></th>              
                <th class="dt-head-center">ID</th>
                <th class="dt-head-center">Descripción</th>
          
            </tr>
        </thead>
        <tfoot>
            <tr> 
            <th class="dt-head-center"></th>  
             <th class="dt-head-center"></th>                
            <th class="dt-head-center">ID</th>
            <th class="dt-head-center">Descripción</th>
         
            </tr>
        </tfoot>
        <tbody>
        @foreach($tamano_papel as $tipo)
           <tr>
           <td  width="4%" style="vertical-align: middle;" class="dt-body-left"> 
                 <p>   
                <button type="button" href="" class="btn btn-warning btn-md fa fa-pencil-square-o" onclick="editar_tamanopapel('{{$tipo->id}}','{{$tipo->descripcion}}')"></button>
                </p>
                </td>
                <td  width="4%" style="vertical-align: middle;" class="dt-body-left"> 
                 <p>      
                {!!link_to_route('caracteristicas.destroytamanopapel', $title = '', $parameters = [$tipo->id], $attributes = ['class'=>"btn  btn-danger fa fa-trash-o",'onclick'=>'return confirm("Esta seguro de borrar este registro?")'])!!} 
               </p>
                </td>
           <td  width="4%" style="vertical-align: middle;" class="dt-body-left">{{$tipo->id}}</td>
           <td  width="88%" style="vertical-align: middle;" class="dt-body-left">{{$tipo->descripcion}}</td>
          
           </tr>
           @endforeach 
     
        </tbody>
    </table>
    </div>
</div>
    <div id="color_papel" style="display:none;" >   
    <div class="col-md-12"> 
   </div> 

    <div class="panel-body col-md-12" >
            <table id="example1" class="table table-striped table-bordered display compact caracteristicas" cellspacing="0" width="100%">
        <thead>
             <tr>     
             <th class="dt-head-center"></th>  
                <th class="dt-head-center"></th>               
                <th class="dt-head-center">ID</th>
                <th class="dt-head-center">Descripción</th>
                  
                  </tr>
        </thead>
        <tfoot>
            <tr>
            <th class="dt-head-center"></th>  
            <th class="dt-head-center"></th> 
            <th class="dt-head-center">ID</th>
            <th class="dt-head-center">Descripción</th>
     
                
         
            </tr>
        </tfoot>
        <tbody>
        @foreach($color_papel as $tipo)
           <tr>
           <td  width="4%" style="vertical-align: middle;"  class="dt-body-left"> 
                 <p>
                   <button type="button" href="" class="btn btn-warning btn-md fa fa-pencil-square-o" onclick="editar_colorpapel('{{$tipo->id}}','{{$tipo->descripcion}}')"></button>
                   </p>
                </td>
                   <td  width="4%" style="vertical-align: middle;"  class="dt-body-left"> 
                 <p>
                {!!link_to_route('caracteristicas.destroycolorpapel', $title = '', $parameters = [$tipo->id], $attributes = ['class'=>"btn btn-danger fa fa-trash-o",'onclick'=>'return confirm("Esta seguro de borrar este registro?")'])!!} 
               </p>
                </td>
           <td  width="4%" style="vertical-align: middle;" class="dt-body-left" >{{$tipo->id}}</td>
           <td  width="88%" style="vertical-align: middle;"  class="dt-body-left">{{$tipo->descripcion}}</td>
   
           </tr>
           @endforeach 
     
        </tbody>
    </table>
    </div>
    </div>
@endsection



@section('especial')
<script>
function mostrar_caracteristicas(){
    var x = document.getElementById("tipo_caracteristica").value;
    if(x=='tipopapel'){
      var x = document.getElementById("tipo_papel");
      var y = document.getElementById("tamano_papel");
      var z = document.getElementById("color_papel");
      y.style.display = "none";
      z.style.display = "none";
      x.style.display = "block";
    }

    if(x=='tamanopapel'){
      var x = document.getElementById("tipo_papel");
      var y = document.getElementById("tamano_papel");
      var z = document.getElementById("color_papel");
      x.style.display = "none";
      y.style.display = "block";
      z.style.display = "none";
    }

    if(x=='colorpapel'){
      var x = document.getElementById("tipo_papel");
      var y = document.getElementById("tamano_papel");
      var z = document.getElementById("color_papel");
      x.style.display = "none";
      y.style.display = "none";
      z.style.display = "block";
    }

    if(x=='null'){
        var x = document.getElementById("tipo_papel");
        var y = document.getElementById("tamano_papel");
        var z = document.getElementById("color_papel");
      x.style.display = "none";
      y.style.display = "none";
      z.style.display = "none";
    }

  }
  </script>
<script>
  var x = document.getElementById("tipo_caracteristica").value;
    if(x=='tipopapel'){
      var x = document.getElementById("tipo_papel");
      var y = document.getElementById("tamano_papel");
      var z = document.getElementById("color_papel");
      y.style.display = "none";
      z.style.display = "none";
      x.style.display = "block";
    }

    if(x=='tamanopapel'){
      var x = document.getElementById("tipo_papel");
      var y = document.getElementById("tamano_papel");
      var z = document.getElementById("color_papel");
      x.style.display = "none";
      y.style.display = "block";
      z.style.display = "none";
    }

    if(x=='colorpapel'){
      var x = document.getElementById("tipo_papel");
      var y = document.getElementById("tamano_papel");
      var z = document.getElementById("color_papel");
      x.style.display = "none";
      y.style.display = "none";
      z.style.display = "block";
    }

    if(x=='null'){
        var x = document.getElementById("tipo_papel");
        var y = document.getElementById("tamano_papel");
        var z = document.getElementById("color_papel");
      x.style.display = "none";
      y.style.display = "none";
      z.style.display = "none";
    }


  
</script>
  <script>

//EVALUA QUE MODAL PRESENTAR CON LOS ERRORES
       @if ($errors->count() > 0 and Session::get('error_code') == 10)
       $(function() {
           $('#tipo_papel_modal_crear').modal('show');
       });
       @endif

       @if ($errors->count() > 0 and Session::get('error_code') == 11)
       $(function() {
           $('#tamano_papel_modal_crear').modal('show');
       });
       @endif

       @if ($errors->count() > 0 and Session::get('error_code') == 12)
       $(function() {
           $('#color_papel_modal_crear').modal('show');
       });
       @endif


</script>
 
<script>
   function editar_tipopapel(id,descripcion){
     console.log(id,descripcion);
       document.getElementById('descripcion_tipo').value = descripcion;
       
       $("#documento").val('');

         $('<input />').attr('type', 'hidden')
          .attr('name', "tipopapel_edit")
          .attr('value', id)
          .appendTo('#create_caracteristica_tipo_papel');

        $('#tipo_papel_modal_crear').modal("show");  
    }

    function nuevo_tipopapel(){
       document.getElementById('descripcion_tipo').value = "";

       $("#documento").val('');

       $('<input />').attr('type', 'hidden')
          .attr('name', "tipopapel_edit")
          .attr('value', 0)
          .appendTo('#create_caracteristica_tipo_papel');  
    }

       $('<input />').attr('type', 'hidden')
          .attr('name', "tipopapel_edit")
          .attr('value', 0)
          .appendTo('#create_caracteristica_tipo_papel'); 


     function editar_tamanopapel(id,descripcion){
     console.log(id,descripcion);
       document.getElementById('descripcion_tamano').value = descripcion;
       
       $("#documento").val('');

         $('<input />').attr('type', 'hidden')
          .attr('name', "tamanopapel_edit")
          .attr('value', id)
          .appendTo('#create_caracteristica_tamano_papel');

        $('#tamano_papel_modal_crear').modal("show");  
    }

    function nuevo_tamanopapel(){
       document.getElementById('descripcion_tamano').value = "";

       $("#documento").val('');

       $('<input />').attr('type', 'hidden')
          .attr('name', "tamanopapel_edit")
          .attr('value', 0)
          .appendTo('#create_caracteristica_tamano_papel');  
    }

       $('<input />').attr('type', 'hidden')
          .attr('name', "tamanopapel_edit")
          .attr('value', 0)
          .appendTo('#create_caracteristica_tamano_papel'); 


       function editar_colorpapel(id,descripcion){
     console.log(id,descripcion);
       document.getElementById('descripcion_color').value = descripcion;
       
       $("#documento").val('');

         $('<input />').attr('type', 'hidden')
          .attr('name', "colorpapel_edit")
          .attr('value', id)
          .appendTo('#create_caracteristica_color_papel');

        $('#color_papel_modal_crear').modal("show");  
    }

    function nuevo_colorpapel(){
       document.getElementById('descripcion_color').value = "";

       $("#documento").val('');

       $('<input />').attr('type', 'hidden')
          .attr('name', "colorpapel_edit")
          .attr('value', 0)
          .appendTo('#create_caracteristica_color_papel');  
    }

       $('<input />').attr('type', 'hidden')
          .attr('name', "colorpapel_edit")
          .attr('value', 0)
          .appendTo('#create_caracteristica_color_papel'); 

</script>
   @include('general/caracteristicas/tipo_papel_modal_crear')
   @include('general/caracteristicas/tamano_papel_modal_crear')
   @include('general/caracteristicas/color_papel_modal_crear')
@stop
