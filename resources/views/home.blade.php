@extends('layouts.app')

@section('content')
  <!--  <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('quickadmin.qa_dashboard')</div>

                <div class="panel-body">
                    @lang('quickadmin.qa_dashboard_text')
                </div>
            </div>
        </div>
    </div>
  -->

    <div class="panel panel-default">
       <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>
        
     <!--    <div><br><button type="button" class="btn">Nuevo</button></div> -->
        
        <div class="panel-body table-responsive">
            <table id="example1" class="display example" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Titulo</th>
                <th>Autores</th>
                <th>F Edicion</th>
                <th>F Ingreso</th>
                <th>Revision de Pares</th>
                <th>F de Publicacion</th>
                <th>ISBN</th>
                <th>IEPI</th>
                <th>Capitulos</th>
                <th></th>      
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Titulo</th>
                <th>Autores</th>
                <th>F Edicion</th>
                <th>F Ingreso</th>
                <th>Revision de Pares</th>
                <th>F de Publicacion</th>
                <th>ISBN</th>
                <th>IEPI</th>
                <th>Capitulos</th>
                <th></th>              
            </tr>
        </tfoot>
        <tbody>
            <tr>
                <td>AAA</td>
                <td>BBB</td>
                <td>CCC</td>
                <td>DDD</td>
                <td>EEE</td>
                <td>FFF</td>
                <td>GGG</td>
                <td>HHH</td>
                <td>III</td>
                <td><button type="button" class="btn">Detalle</button>
                    <button type="button" class="btn">Modificar</button>
                    <button type="button" class="btn">Eliminar</button>
                </td>
            </tr>
            <tr>
                  <td>AAA</td>
                <td>BBB</td>
                <td>CCC</td>
                <td>DDD</td>
                <td>EEE</td>
                <td>FFF</td>
                <td>GGG</td>
                <td>HHH</td>
                <td>III</td>
                <td><button type="button" class="btn">Detalle</button>
                    <button type="button" class="btn">Modificar</button>
                    <button type="button" class="btn">Eliminar</button>
                </td>
            </tr>           
        </tbody>
    </table>
        </div>
    </div>

   <div class="container col-md-12">
  <h2>Estados</h2>
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Libro</a></li>
    <li><a data-toggle="tab" href="#estado1">ESTADO 1</a></li>
    <li><a data-toggle="tab" href="#estado2">ESTADO 2</a></li>
    <li><a data-toggle="tab" href="#estado3">ESTADO 3</a></li>
    <li><a data-toggle="tab" href="#estado4">ESTADO 4</a></li>
    <li><a data-toggle="tab" href="#estado5">ESTADO 5</a></li>
    <li><a data-toggle="tab" href="#estado6">ESTADO 6</a></li>
    <li><a data-toggle="tab" href="#estado7">ESTADO 7</a></li>
    <li><a data-toggle="tab" href="#estado8">ESTADO 8</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <h3>LIBRO</h3>
     <button type="button" class="btn">DOCUMENTO</button>
    </div>
    <div id="estado1" class="tab-pane fade">
      <h3>ESTADO 1: INGRESADO</h3>
      <button type="button" class="btn">DOCUMENTO</button>
    </div>
    <div id="estado2" class="tab-pane fade">
      <h3>ESTADO 2: APROBADO PARA EDICION</h3>
      <button type="button" class="btn">DOCUMENTO</button>
    </div>
    <div id="estado3" class="tab-pane fade">
      <h3>ESTADO 3: EDICION</h3>
      <button type="button" class="btn">DOCUMENTO</button>
    </div>
    <div id="estado4" class="tab-pane fade">
      <h3>ESTADO 4: CORRECCION EDICION</h3>
      <button type="button" class="btn">DOCUMENTO</button>
    </div>
    <div id="estado5" class="tab-pane fade">
      <h3>ESTADO 5: EDITADO</h3>
      <button type="button" class="btn">DOCUMENTO</button>
    </div>
    <div id="estado6" class="tab-pane fade">
      <h3>ESTADO 6: COTIZACION</h3>
      <button type="button" class="btn">DOCUMENTO</button>
    </div>
    <div id="estado7" class="tab-pane fade">
      <h3>ESTADO 7: PRODUCCION</h3>
      <button type="button" class="btn">DOCUMENTO</button>
    </div>
    <div id="estado8" class="tab-pane fade">
      <h3>ESTADO 8: PUBLICADO</h3>
      <button type="button" class="btn">DOCUMENTO</button>
    </div>

  </div>
</div>    
@endsection
