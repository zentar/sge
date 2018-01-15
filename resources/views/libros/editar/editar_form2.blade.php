<div class="container col-md-12">

<div class="row">
   <div class="col-md-8">
      <h3>{{$libro->titulo}}</h3>
   </div>
   <div class="col-md-4">
      <div class="row">
         <div class="col-md-7">
           <h3>Estado: {{$libro->estados->nombre}} </h3> 
         </div>
         <div class="col-md-5">
            <a href="{{ url('/') }}">     
                    <span class="title"><h3>Avanzar</h3></span>
                </a>
         </div>
      </div>
   </div>
</div>


  <ul class="nav nav-tabs" id="tab_libro">
    <li class="active"><a class=" tableta fa fa-info-circle" data-toggle="tab" href="#informacion"> Información</a></li>
    <li><a class=" tableta fa fa-file" data-toggle="tab" href="#documentos"> Documentos</a></li>
    <li><a class=" tableta fa fa-list-ul" data-toggle="tab" href="#caracteristicas"> Caracteristicas</a></li>
    <li><a class=" tableta fa fa-money" data-toggle="tab" href="#cotizaciones"> Cotizaciones</a></li>
    <li><a class=" tableta fa fa-history" data-toggle="tab" href="#historico"> Historico</a></li>
  </ul>

  <div class="tab-content">
    <div id="informacion" class="tab-pane pane fade in active">
      <div class = "espacio col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"></div>  
      <div class="tableta col-md-12"> 
      @include('libros/editar/informacion_libro') 
</div>
    </div>  
    <div id="documentos" class="tab-pane fade">
    <div class = "espacio col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"></div>
        <div class="tableta col-md-12"> 
      @include('libros/editar/documentos')

    </div>
    </div>
    <div id="caracteristicas" class="tab-pane fade">
    <div class = "espacio col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"></div>
        <div class="tableta col-md-12"> 
      @include('libros/editar/caracteristicas_libro') 
    </div>
    </div>
    <div id="cotizaciones" class="tab-pane fade">
    <div class = "espacio col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"></div>
       <div class="tableta col-md-12"> 
     @include('libros/editar/cotizaciones_libro')
     </div> 
    </div>
    <div id="historico" class="tab-pane fade">
    <div class = "espacio col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"></div>
        <div class="tableta col-md-12"> 
      @include('libros/editar/historico_libro') 
    </div>
    </div>
  </div>

</div>
