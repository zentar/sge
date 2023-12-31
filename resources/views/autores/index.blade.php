@extends('layouts.app')
@section('content')
    <h1 class="page-title">@lang('quickadmin.qa_au_index')</h1>

      <div class="row container-fluid ">
      <div class="box-body table-responsive">
           {!! link_to_route('autor.create', $title = ' Nuevo',$parameters = null ,$attributes = ['class'=>"btn btn-success fa fa-plus"] ) !!}</p>         
        <div class="panel-body">
            <table id="table_autores" class="table table-striped table-bordered display compact autores" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="dt-head-center">ID</th>
                <th class="dt-head-center">Cédula</th>
                <th class="dt-head-center">Nombre</th>
                <th class="dt-head-center">Correo</th>
                <th class="dt-head-center">Teléfono</th>
                <th class="dt-head-center"></th>  
                <th class="dt-head-center"></th> 
                <th class="dt-head-center"></th>  

            </tr>
        </thead>
        <tfoot>
            <tr>
                <th class="dt-head-center">ID</th>
                <th class="dt-head-center">Cédula</th>
                <th class="dt-head-center">Nombre</th>
                <th class="dt-head-center">Correo</th>
                <th class="dt-head-center">Teléfono</th>
                <th class="dt-head-center"></th> 
                <th class="dt-head-center"></th> 
                <th class="dt-head-center"></th>                
            </tr>
        </tfoot>
        <tbody>
           @foreach($autores as $autor)
            <tr>    
                <td  style="vertical-align: middle;" class="dt-body-left">{{$autor->id}}</td>          
                <td  style="vertical-align: middle;" class="dt-body-left">{{$autor->cedula}}</td>
                <td  style="vertical-align: middle;" class="dt-body-left">{{$autor->nombre}} {{$autor->apellido}}</td>
                <td  style="vertical-align: middle;" class="dt-body-left">{{$autor->email}}</td> 
                <td  style="vertical-align: middle;" class="dt-body-left">{{$autor->telefono}}</td>
                <td  style="vertical-align: middle;" class="dt-body-center"> 
                 <p>
                {!!link_to_route('autor.consultar', $title = '', $parameters = $autor->id, $attributes = ['class'=>"btn btn-primary   fa fa-eye"])!!}
                </p>
                </td>
                <td  style="vertical-align: middle;" class="dt-body-center"> 
                 <p>
                {!!link_to_route('autor.edit', $title = '', $parameters = $autor->id, $attributes = ['class'=>"btn btn-warning  fa fa-pencil-square-o"])!!}
                </p>
                </td>
                <td  style="vertical-align: middle;" class="dt-body-center"> 
                 <p>
                {!!link_to_route('autor.delete', $title = '', $parameters = $autor->id, $attributes = ['class'=>"btn btn-danger  fa fa-trash-o",'onclick'=>'return confirm("Esta seguro de borrar este registro?")'])!!}
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
