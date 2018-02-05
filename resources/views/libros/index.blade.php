@extends('layouts.app')
@section('content')
      <div class="row container-fluid ">
      <div class="box-body table-responsive">

      <h1 class="page-title">@lang('quickadmin.qa_li_index')</h1>
      @can('libro_create')     
      {!! link_to_route('libro.create', $title = 'Nuevo',$parameters = null ,$attributes = ['class'=>"btn btn-success "] ) !!}</p> 
      @endcan
        <div class="panel-body">
            <table id="example1" class="table table-striped table-bordered display compact libros" cellspacing="0" width="100%">
        <thead>
            <tr>
                 
                <th class="dt-head-center">ID</th>
                <th class="dt-head-center">Título</th>
                <th class="dt-head-center">Autores</th>
                <th class="dt-head-center">Fecha de ingreso</th>
                <th class="dt-head-center">Colección</th>
                <th class="dt-head-center">Estado</th>
            
                @if(Gate::allows('libro_view') || Gate::allows('libro_edit') || Gate::allows('libro_delete'))<th class="dt-head-center"></th>   @endif
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
         
                @if(Gate::allows('libro_view') || Gate::allows('libro_edit') || Gate::allows('libro_delete'))    <th class="dt-head-center"></th>   @endif           
            </tr>
        </tfoot>
        <tbody>
           
     

           @foreach($libros as $libro)
            <tr>
              
                <td width="2%" class="dt-body-center">{{$libro->id}}</td>
                <td width="33%">{{$libro->titulo}}</td>

                <!-- LAZO DE RELACION MUCHO A MUCHOS LIBRO - AUTOR-->
                <td width="15%" class="dt-body-left">
                @foreach ($libro->autor as $name) 
                {{$name->nombre}} {{$name->apellido}} <br>               
                @endforeach  
                </td> 

                <td width="15%" class="dt-body-left"> {{ Carbon\Carbon::parse($libro->created_at)->format('d/m/Y') }}</td> 
                <td width="10%" class="dt-body-left">{{$libro->coleccion->titulo}}</td> 
                <td width="10%" class="dt-body-left">{{$libro->estados->nombre}}</td>

                @if(Gate::allows('libro_view') || Gate::allows('libro_edit') || Gate::allows('libro_delete'))       
                 <td width="15%" class="dt-body-center"> 
                @can('libro_view')
                {!!link_to_route('libro.show', $title = '', $parameters = $libro->id, $attributes = ['class'=>"btn btn-primary fa fa-eye"])!!}
                @endcan
              @can('libro_edit')  
                {!!link_to_route('libro.edit', $title = '', $parameters = $libro->id, $attributes = ['class'=>"btn btn-warning btn-md fa fa-pencil-square-o"])!!}
                @endcan
              @can('libro_delete')
                {!!link_to_route('libro.delete', $title = '', $parameters = $libro->id, $attributes = ['class'=>"btn btn-danger btn-danger btn-md fa fa-trash-o ",'onclick'=>'return confirm("Esta seguro de borrar este registro?")'])!!}
                @endcan                
                </td>
                @endif                
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




