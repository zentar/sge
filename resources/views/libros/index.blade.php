@extends('layouts.app')
@section('content')
      <div class="row container-fluid ">
      <div class="box-body table-responsive">

      <h1 class="page-title">@lang('quickadmin.qa_li_index')</h1>
           
      {!! link_to_route('libro.create', $title = 'Nuevo',$parameters = null ,$attributes = ['class'=>"btn btn-success "] ) !!}</p> 

        <div class="panel-body">
            <table id="example1" class="table table-striped table-bordered display compact libros" cellspacing="0" width="100%">
        <thead>
            <tr>
                 
                <th class="dt-head-center">ID</th>
                <th class="dt-head-center">Título</th>
                <th class="dt-head-center">Autores</th>
                <th class="dt-head-center">Fecha de ingreso</th>
                <th class="dt-head-center">Estado</th>
                <th class="dt-head-center"></th>   
            </tr>
        </thead>
        <tfoot>
            <tr>
                 
                <th class="dt-head-center">ID</th>
                <th class="dt-head-center">Título</th>
                <th class="dt-head-center">Autores</th>
                <th class="dt-head-center">Fecha de ingreso</th>
                <th class="dt-head-center">Estado</th>
                <th class="dt-head-center"></th>             
            </tr>
        </tfoot>
        <tbody>
           
     

           @foreach($libros as $libro)
            <tr>
              
                <td class="dt-body-center">{{$libro->id}}</td>
                <td>{{$libro->titulo}}</td>

                <!-- LAZO DE RELACION MUCHO A MUCHOS LIBRO - AUTOR-->
                <td class="dt-body-center">
                @foreach ($libro->autor as $name) 
                {{$name->nombre}} {{$name->apellido}} <br>               
                @endforeach  
                </td> 

                <td class="dt-body-center">{{$libro->created_at}}</td> 
                
                <td class="dt-body-center">{{$libro->estados->nombre}}</td> 

                 <td class="dt-body-center"> 
         
                {!!link_to_route('libro.show', $title = '', $parameters = $libro->id, $attributes = ['class'=>"btn btn-primary fa fa-eye"])!!}
                
                {!!link_to_route('libro.edit', $title = '', $parameters = $libro->id, $attributes = ['class'=>"btn btn-primary btn-warning btn-md fa fa-pencil-square-o"])!!}
              
                {!!link_to_route('libro.delete', $title = '', $parameters = $libro->id, $attributes = ['class'=>"btn btn-danger btn-danger btn-md fa fa-trash-o ",'onclick'=>'return confirm("Esta seguro de borrar este registro?")'])!!}
                
                </td>
                
            </tr>
            @endforeach        
        </tbody>
    </table>
    </div>
    </div>
</div> 
</div> 
@endsection





