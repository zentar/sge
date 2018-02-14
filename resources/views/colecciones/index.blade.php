@extends('layouts.app')
@section('content')
    <h1 class="page-title">@lang('quickadmin.qa_col_index')</h1>

      <div class="row container-fluid ">
      <div class="box-body table-responsive">
           {!! link_to_route('coleccion.create', $title = ' Nuevo',$parameters = null ,$attributes = ['class'=>"btn btn-success fa fa-plus"] ) !!}</p>         
        <div class="panel-body">
            <table id="table_estados" class="table table-bordered tabke-striped display compact colecciones" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="dt-head-center">Id</th>
                <th class="dt-head-center">Título</th>
                <th class="dt-head-center">Descripción</th>
                <th class="dt-head-center"></th>  
                  <th class="dt-head-center"></th>   
                    <th class="dt-head-center"></th>    

            </tr>
        </thead>
        <tfoot>
            <tr>
                <th class="dt-head-center">Id</th>
                <th class="dt-head-center">Título</th>
                <th class="dt-head-center">Descripción</th>
                <th class="dt-head-center"></th>  
                  <th class="dt-head-center"></th>   
                    <th class="dt-head-center"></th>                 
            </tr>
        </tfoot>
        <tbody>
           @foreach($colecciones as $coleccion)
            <tr>    
                <td  style="vertical-align: middle;" class="dt-body-center">{{$coleccion->id}}</td>          
                <td  style="vertical-align: middle;" class="dt-body-center">{{$coleccion->titulo}}</td>
                <td  style="vertical-align: middle;" class="dt-body-center">{{$coleccion->descripcion}}</td>
                <td  style="vertical-align: middle;" class="dt-body-center"> 
                 <p>
                {!!link_to_route('coleccion.show', $title = '', $parameters = $coleccion->id, $attributes = ['class'=>"btn btn-primary fa fa-eye"])!!}
                </p>
                </td>
                <td  style="vertical-align: middle;" class="dt-body-center"> 
                 <p>

                {!!link_to_route('coleccion.edit', $title = '', $parameters = $coleccion->id, $attributes = ['class'=>"btn btn-warning fa fa-pencil-square-o"])!!}
                </p>
                </td>
                <td  style="vertical-align: middle;" class="dt-body-center"> 
                 <p>
                
                {!!link_to_route('coleccion.destroy', $title = '', $parameters = $coleccion->id, $attributes = ['class'=>"btn btn-danger fa fa-trash-o",'onclick'=>'return confirm("Esta seguro de borrar este registro?")'])!!}
               </p>
                </td>
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
