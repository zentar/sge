<div class="container col-md-12">
  <h3>{{$libro->titulo}}</h3>
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#informacion">Información</a></li>
    <li><a data-toggle="tab" href="#documentos">Documentos</a></li>
    <li><a data-toggle="tab" href="#caracteristicas">Caracteristicas</a></li>
    <li><a data-toggle="tab" href="#cotizaciones">Cotizaciones</a></li>
    <li><a data-toggle="tab" href="#historico">Historico</a></li>
  </ul>

  <div class="tab-content">
    <div id="informacion" class="tab-pane pane fade in active">
      @include('libros/editar/informacion_libro')   
    </div>  
    <div id="documentos" class="tab-pane fade">
      @include('libros/editar/documentos') 
    </div>
    <div id="caracteristicas" class="tab-pane fade">
      @include('libros/editar/caracteristicas_libro') 
    </div>
    <div id="cotizaciones" class="tab-pane fade">
      @include('libros/editar/cotizaciones_libro') 
    </div>
    <div id="historico" class="tab-pane fade">
      @include('libros/editar/historico_libro') 
    </div>
  </div>

</div>
