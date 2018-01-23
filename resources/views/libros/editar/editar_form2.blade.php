<div class="container col-md-12">

<div class="row">
   <div class="col-md-8">
      <h3>{{$libro->titulo}}</h3>
   </div>
   <div class="col-md-4"> 
           <h3 align="right">Estado: {{$libro->estados->nombre}} </h3>    
   </div>
</div>


  <ul class="nav nav-tabs" id="tab_libro">
   @can('libro_edit_informacion')<li class="active"><a class=" tableta fa fa-info-circle" data-toggle="tab" href="#informacion"> Información</a></li>@endcan
   @can('libro_edit_edicion') @if($libro->estados_id >= 2) <li><a class=" tableta fa fa-pencil" data-toggle="tab" href="#edicion"> Edición</a></li>@endcan  @endif 
   @can('libro_edit_documentos') <li><a class=" tableta fa fa-file" data-toggle="tab" href="#documentos"> Documentos</a></li>@endcan 
   @can('libro_edit_caracteristicas') <li><a class=" tableta fa fa-list-ul" data-toggle="tab" href="#caracteristicas"> Caracteristicas</a></li>@endcan 
   @can('libro_edit_cotizaciones') <li><a class=" tableta fa fa-money" data-toggle="tab" href="#cotizaciones"> Cotizaciones</a></li>@endcan 
   @can('libro_edit_historico') <li><a class=" tableta fa fa-history" data-toggle="tab" href="#historico"> Historico</a></li>@endcan 
  </ul>

  <div class="tab-content">

  @can('libro_edit_informacion')
    <div id="informacion" class="tab-pane pane fade in active">
      <div class = "espacio col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"></div>  
      <div class="tableta col-md-12"> 
      @include('libros/editar/informacion_libro') 
</div>
    </div> 
  @endcan   

  
  @can('libro_edit_edicion')
    <div id="edicion" class="tab-pane pane fade">
      <div class = "espacio col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"></div>  
      <div class="tableta col-md-12"> 
      @if( $libro->estados_id >= 2) @include('libros/editar/edicion_libro') @endif
    </div>
    </div> 
  @endcan   

  @can('libro_edit_documentos')
    <div id="documentos" class="tab-pane fade">
    <div class = "espacio col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"></div>
        <div class="tableta col-md-12"> 
      @include('libros/editar/documentos')

    </div>
    </div>
  @endcan 
   @can('libro_edit_caracteristicas')  
    <div id="caracteristicas" class="tab-pane fade">
    <div class = "espacio col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"></div>
        <div class="tableta col-md-12"> 
       @include('libros/editar/caracteristicas_libro') 
    </div>
    </div>
   @endcan
   @can('libro_edit_cotizaciones')
    <div id="cotizaciones" class="tab-pane fade">
    <div class = "espacio col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"></div>
       <div class="tableta col-md-12"> 
     @include('libros/editar/cotizaciones_libro')
     </div> 
    </div>
   @endcan
   @can('libro_edit_historico')
    <div id="historico" class="tab-pane fade">
    <div class = "espacio col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"></div>
        <div class="tableta col-md-12"> 
      @include('libros/editar/historico_libro') 
    </div>
    </div>
    @endcan
  </div>

</div>
