@extends('layouts.app')
@section('content')
      <div class="row container-fluid ">
      <div class="box-body table-responsive">

      <h1 class="page-title">@lang('quickadmin.qa_li_index')</h1>
      @can('libro_create')     
      {!! link_to_route('libro.create', $title = ' Nuevo',$parameters = null ,$attributes = ['class'=>"btn btn-success fa fa-plus"] ) !!}</p> 
      @endcan
        <div class="panel-body">
            <table id="example1" class="table table-stripes table-bordered display compact libros" cellspacing="0" width="100%">
        <thead>
            <tr>
                 
                <th class="dt-head-center">ID</th>
                <th class="dt-head-center">Título</th>
                <th class="dt-head-center">Autores</th>
                <th class="dt-head-center">Fecha de ingreso</th>
                <th class="dt-head-center">Colección</th>
                <th class="dt-head-center">Estado</th>            
                @if(Gate::allows('libro_view')) 
                <th class="dt-head-center"></th>
                @endif

                @if(Gate::allows('libro_edit')) 
                <th class="dt-head-center"></th>
                @endif

                @if(Gate::allows('libro_delete')) 
                <th class="dt-head-center"></th>
                @endif
                 
              </tr>
        </thead>
        <tfoot>
            <tr>
                 
                <th class="dt-head-center">ID</th>
                <th class="dt-head-center">Título</th>
                <th class="dt-head-center">Autores</th>
                <th class="dt-head-center">Fecha de ingreso</th>
                <th class="dt-head-center">Colección</th>
                <th class="dt-head-center">Estado</th>
         
                @if(Gate::allows('libro_view')) 
                <th class="dt-head-center"></th> 
                @endif

                @if(Gate::allows('libro_edit')) 
                <th class="dt-head-center"></th> 
                @endif

                @if(Gate::allows('libro_delete')) 
                <th class="dt-head-center"></th> 
                @endif  </tr>
        </tfoot>
        <tbody>
           
     

           @foreach($libros as $libro)
            <tr>
              
                <td width="2%"  style="vertical-align: middle;" class="dt-body-center">{{$libro->id}}</td>
                <td width="32%" style="vertical-align: middle;">{{$libro->titulo}}</td>

                <!-- LAZO DE RELACION MUCHO A MUCHOS LIBRO - AUTOR-->
                <td width="19%"  style="vertical-align: middle;" class="dt-body-left">
                <ul>
                @foreach ($libro->autor as $name) 
              <li>  {{$name->nombre}} {{$name->apellido}} </li>               
                @endforeach  
                </ul>
                </td> 

                <td width="11%"  style="vertical-align: middle;" class="dt-body-left"> {{ Carbon\Carbon::parse($libro->created_at)->format('d/m/Y') }}</td> 
                <td width="15%"  style="vertical-align: middle;" class="dt-body-left">{{$libro->coleccion->titulo}}</td> 
                <td width="10%"  style="vertical-align: middle;" class="dt-body-left">{{$libro->estados->nombre}}</td>

                 
             
                 
                @can('libro_view')
                <td width="2%"  style="vertical-align: middle;" class="dt-body-center"> 
                {!!link_to_route('libro.show', $title = '', $parameters = $libro->id, $attributes = ['class'=>"btn btn-primary btn-md fa fa-eye"])!!}
                </td>
                @endcan
     
             
              @can('libro_edit')  
              <td width="2%"  style="vertical-align: middle;" class="dt-body-center">

                {!!link_to_route('libro.edit', $title = '', $parameters = $libro->id, $attributes = ['class'=>"btn btn-warning btn-md fa fa-pencil-square-o"])!!}
                </td>
                @endcan
         
           
              @can('libro_delete')
              <td width="2%"  style="vertical-align: middle;" class="dt-body-center"> 
             
                {!!link_to_route('libro.delete', $title = '', $parameters = $libro->id, $attributes = ['class'=>"btn btn-danger btn-danger btn-md fa fa-trash-o ",'onclick'=>'return confirm("Esta seguro de borrar este registro?")'])!!}
          
                </td>
                @endcan  

                       
            </tr>
            @endforeach        
        </tbody>
    </table>
    </div>
    </div>
</div> 
</div> 
@endsection

@section('especial')
<script>
    //RESETEA TABA CTIVA PARA NUEVA CONSULTAS
    localStorage.setItem('activeTab', null);
</script>

@endsection




