@extends('layouts.app')
@section('content')
<h1 class="page-title">@lang('quickadmin.qa_aud_index')</h1> 
      <div class="row container-fluid ">
      <div class="box-body table-responsive">

            
    
        <div class="panel-body">
            <table id="example1" class="table table-striped table-bordered display compact auditoria" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="dt-head-center">ID</th>
                <th class="dt-head-center">Título</th>
                <th class="dt-head-center">Entidad</th>
                <th class="dt-head-center">Acción</th>
                <th class="dt-head-center">Descripción</th>
                <th class="dt-head-center">Tipo</th>
                <th class="dt-head-center">Dirección ip</th>
                <th class="dt-head-center">Pc</th>
                <th class="dt-head-center">Usuario</th>
                <th class="dt-head-center">Rol</th>
          
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th class="dt-head-center">ID</th>
                <th class="dt-head-center">Título</th>
                <th class="dt-head-center">Entidad</th>
                <th class="dt-head-center">Acción</th>
                <th class="dt-head-center">Descripción</th>
                <th class="dt-head-center">Tipo</th>
                <th class="dt-head-center">Dirección ip</th>
                <th class="dt-head-center">Pc</th>
                <th class="dt-head-center">Usuario</th>
                <th class="dt-head-center">Rol</th>
                  
            </tr>
        </tfoot>
        <tbody>
           
     

        @foreach($auditorias as $auditoria)
            <tr>              
                <td class="dt-body-center">{{$auditoria->id}}</td>
                <td class="dt-body-center">{{$auditoria->titulo}}</td>
                <td class="dt-body-center">{{$auditoria->entidad}}</td> 
                <td class="dt-body-center">{{$auditoria->accion}}</td>
                <td class="dt-body-center">{{$auditoria->descripcion}}</td>
                <td class="dt-body-center">{{$auditoria->tipo}}</td>
                <td class="dt-body-center">{{$auditoria->ip}}</td>
                <td class="dt-body-center">{{$auditoria->pc}}</td>
                <td class="dt-body-center">{{$auditoria->user_id}}</td>
                <td class="dt-body-center">{{$auditoria->role_id}}</td>
               
               
            </tr>
            @endforeach        
        </tbody>
    </table>
    </div>
    </div>
</div> 
</div> 
@endsection


