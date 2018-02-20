@extends('layouts.app')
@section('content')
<h1 class="page-title">Campos Generales</h1>

<div class="row container-fluid ">
<div class="box-body table-responsive">
     {!! link_to_route('parametros.create', $title = ' Nuevo',$parameters = null ,$attributes = ['class'=>"btn btn-success fa fa-plus"] ) !!}</p>         
  <div class="panel-body">
      <table id="table_estados" class="table table-bordered tabke-striped display compact facultades" cellspacing="0" width="100%">
  <thead>
      <tr>
             <th class="dt-head-center"></th>
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
          <th class="dt-head-center"></th>
          <th class="dt-head-center">Id</th>        
          <th class="dt-head-center">Código</th>
          <th class="dt-head-center">Título</th>
      </tr>
  </tfoot>
  <tbody>
     @foreach($campos_generales as $campo_general)
     
      <tr>
      
       <td width="4%"  style="vertical-align: middle;" class="dt-body-left"> 

       {!!link_to_route('parametros.edit', $title = '', $parameters = $campo_general->id, $attributes = ['class'=>"btn btn-primary fa fa-plus"])!!}

       </td> 
     
        <td width="4%"  style="vertical-align: middle;" class="dt-body-left"> 

       {!!link_to_route('parametros.editGeneral', $title = '', $parameters = $campo_general->id, $attributes = ['class'=>"btn btn-warning fa fa-pencil-square-o"])!!}

      </td>

       
       <td width="4%"  style="vertical-align: middle;" class="dt-body-left"> 
     
       {!!link_to_route('parametros.destroy', $title = '', $parameters = $campo_general->id, $attributes = ['class'=>"btn btn-danger fa fa-trash-o",'onclick'=>'return confirm("Esta seguro de borrar este registro?")'])!!}

       </td>
          <td width="4%"  style="vertical-align: middle;" class="dt-body-left">{{$campo_general->id}}</td> 
          <td width="4%"  style="vertical-align: middle;" class="dt-body-left">{{$campo_general->codigo}}</td>          
          <td width="84%"  style="vertical-align: middle;" class="dt-body-left">{{$campo_general->titulo}}</td>          
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