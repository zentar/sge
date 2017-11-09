@extends('layouts.app')
@section('content')
      <div class="row container-fluid ">
      <div class="box-body table-responsive">
           {!! link_to_route('autor.create', $title = 'Nuevo',$parameters = null ,$attributes = ['class'=>"btn btn-primary "] ) !!}</p>         
        <div class="panel-body">
            <table id="table_autores" class="table table-striped table-bordered display compact autores" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="dt-head-center">Id</th>
                <th class="dt-head-center">Cedula</th>
                <th class="dt-head-center">Nombre</th>
                <th class="dt-head-center">Email</th>
                <th class="dt-head-center">Telefono</th>
                <th class="dt-head-center"></th>   

            </tr>
        </thead>
        <tfoot>
            <tr>
                <th class="dt-head-center">Id</th>
                <th class="dt-head-center">Cedula</th>
                <th class="dt-head-center">Nombre</th>
                <th class="dt-head-center">Email</th>
                <th class="dt-head-center">Telefono</th>
                <th class="dt-head-center"></th>                
            </tr>
        </tfoot>
        <tbody>
           @foreach($autores as $autor)
            <tr>    
                <td class="dt-body-center">{{$autor->id}}</td>          
                <td class="dt-body-center">{{$autor->cedula}}</td>
                <td class="dt-body-center">{{$autor->nombre}} {{$autor->apellido}}</td>
                <td class="dt-body-center">{{$autor->email}}</td> 
                <td class="dt-body-center">{{$autor->telefono}}</td>
                <td class="dt-body-center"> 
                 <p>
                {!!link_to_route('autor.consultar', $title = 'Consultar', $parameters = $autor->id, $attributes = ['class'=>"btn btn-primary "])!!}

                {!!link_to_route('autor.edit', $title = 'Editar', $parameters = $autor->id, $attributes = ['class'=>"btn btn-primary "])!!}
                
                {!!link_to_route('autor.delete', $title = 'Eliminar', $parameters = $autor->id, $attributes = ['class'=>"btn btn-danger ",'onclick'=>'return confirm("Esta seguro de borrar este registro?")'])!!}
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
