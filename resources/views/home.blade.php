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

      <!-- <div class="panel panel-default">
       <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>-->
    
      <div class="row container-fluid ">
      <div class="box-body table-responsive">

           {!! link_to_route('libro.create', $title = 'Nuevo',$parameters = null ,$attributes = ['class'=>"btn btn-primary "] ) !!}</p> 
        
        <div class="panel-body">
            <table id="example1" class="table table-striped table-bordered display compact libros" cellspacing="0" width="100%">
        <thead>
            <tr>
                 
                <th class="dt-head-center">ID</th>
                <th class="dt-head-center">Titulo</th>
                <th class="dt-head-center">Autores</th>
                <th class="dt-head-center">Fecha Publicacion</th>
                <th class="dt-head-center"></th>   
            </tr>
        </thead>
        <tfoot>
            <tr>
                 
                <th class="dt-head-center">ID</th>
                <th class="dt-head-center">Titulo</th>
                <th class="dt-head-center">Autores</th>
                <th class="dt-head-center">Fecha Publicacion</th>
                <th class="dt-head-center"></th>             
            </tr>
        </tfoot>
        <tbody>
           @foreach($libros as $libro)
            <tr>
              
                <td class="dt-body-center">{{$libro->id}}</td>
                <td>{{$libro->titulo}}</td>
                <td>{{$libro->autores}}</td>
                <td class="dt-body-center">{{$libro->created_at}}</td> 
                 <td class="dt-body-center"> 
                 <p>
                {!!link_to_route('libro.consultar', $title = 'Consultar', $parameters = $libro->id, $attributes = ['class'=>"btn btn-primary "])!!}

                {!!link_to_route('libro.edit', $title = 'Editar', $parameters = $libro->id, $attributes = ['class'=>"btn btn-primary "])!!}
                
                {!!link_to_route('libro.delete', $title = 'Eliminar', $parameters = $libro->id, $attributes = ['class'=>"btn btn-danger ",'onclick'=>'return confirm("Esta seguro de borrar este registro?")'])!!}
               </p>
                </td>
            </tr>
            @endforeach        
        </tbody>
    </table>
        </div>
    </div>

     <!-- <div class="container col-md-12">
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

  </div>-->
</div> 
</div> 
</div> 
    
@endsection
