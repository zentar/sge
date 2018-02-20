@extends('layouts.app')
@section('content')
<h1 class="page-title">Campos Detallado de: {{$campos_especifico->titulo}}</h1>

<div class="row container-fluid ">
<div class="box-body table-responsive">
<a type="button" href="{{route('parametros.edit', ['id' => $campos_especifico->campo_general])}}" class="btn btn-primary fa fa-arrow-left"></a>
   
     {!! link_to_route('parametros.nuevoDetallado', $title = ' Nuevo',$parameters = ['id' => $campos_especifico->id] ,$attributes = ['class'=>"btn btn-success fa fa-plus"] ) !!}</p>         
  <div class="panel-body">
      <table id="table_estados" class="table table-bordered tabke-striped display compact facultades" cellspacing="0" width="100%">
  <thead>
      <tr>
          <th class="dt-head-center"></th>
          <th class="dt-head-center"></th>
          <th class="dt-head-center">Id</th> 
          <th class="dt-head-center">Código</th>
          <th class="dt-head-center">Título</th>
      </tr>
  </thead>
  <tfoot>
      <tr>     
          <th class="dt-head-center"></th>
          <th class="dt-head-center"></th>
          <th class="dt-head-center">Id</th>        
          <th class="dt-head-center">Código</th>
          <th class="dt-head-center">Título</th>
      </tr>
  </tfoot>
  <tbody>
     @foreach($detalle as $campo_detallado)
      <tr>    

      
       <td width="4%"  style="vertical-align: middle;" class="dt-body-left"> 

       {!!link_to_route('parametros.editDetallado', $title = '', $parameters = $campo_detallado->id, $attributes = ['class'=>"btn btn-warning fa fa-pencil-square-o"])!!}

       </td>
       
       <td width="4%"  style="vertical-align: middle;" class="dt-body-left"> 
     
       {!!link_to_route('parametros.destroyDetallado', $title = '', $parameters = $campo_detallado->id, $attributes = ['class'=>"btn btn-danger fa fa-trash-o",'onclick'=>'return confirm("Esta seguro de borrar este registro?")'])!!}

       </td>
          <td width="4%"  style="vertical-align: middle;" class="dt-body-left">{{$campo_detallado->id}}</td> 
          <td width="4%"  style="vertical-align: middle;" class="dt-body-left">{{$campo_detallado->codigo}}</td>          
          <td width="84%"  style="vertical-align: middle;" class="dt-body-left">{{$campo_detallado->titulo}}</td>          
      </tr>
      @endforeach        
  </tbody>
</table>
  </div>
</div>
</div> 
</div> 
</div> 

@endsection