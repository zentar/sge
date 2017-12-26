<div class="container col-md-12">
  <h3>{{$libro->titulo}}</h3>
  <ul class="nav nav-tabs">
    <li class="active"><a class="fa fa-info-circle" data-toggle="tab" href="#informacion"> Información</a></li>
    <li><a class="fa fa-file" data-toggle="tab" href="#documentos"> Documentos</a></li>
    <li><a class="fa fa-list-ul" data-toggle="tab" href="#caracteristicas"> Caracteristicas</a></li>
    <li><a class="fa fa-money" data-toggle="tab" href="#cotizaciones"> Cotizaciones</a></li>
    <li><a class="fa fa-history" data-toggle="tab" href="#historico"> Historico</a></li>
  </ul>

  <div class="tab-content">
    <div id="informacion" class="tab-pane pane fade in active">
      <div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="margin-top:1%"></div>  
      @include('libros/consultar/informacion_libro') 
    </div>  
    <div id="documentos" class="tab-pane fade">
    <div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="margin-top:1%"></div>
      @include('libros/consultar/documentos') 
    </div>
    <div id="caracteristicas" class="tab-pane fade">
    <div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="margin-top:1%"></div>
      @include('libros/consultar/caracteristicas_libro') 
    </div>
    <div id="cotizaciones" class="tab-pane fade">
    <div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="margin-top:1%"></div>
      @include('libros/consultar/cotizaciones_libro') 
    </div>
    <div id="historico" class="tab-pane fade">
    <div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="margin-top:1%"></div>
      @include('libros/consultar/historico_libro') 
    </div>
  </div>

</div>
