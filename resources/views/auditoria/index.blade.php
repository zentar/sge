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
                <th class="dt-head-center">Descripción</th>
                <th class="dt-head-center">Subject_id</th>
                <th class="dt-head-center">Subject_type</th>
                <th class="dt-head-center">Causer_id</th>
                <th class="dt-head-center">Causer_type</th>
                <th class="dt-head-center">Propiedades</th>
                <th class="dt-head-center">Fecha de Creación</th>   
          
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th class="dt-head-center">ID</th>
                <th class="dt-head-center">Título</th>
                <th class="dt-head-center">Descripción</th>
                <th class="dt-head-center">Subject_id</th>
                <th class="dt-head-center">Subject_type</th>
                <th class="dt-head-center">Causer_id</th>
                <th class="dt-head-center">Causer_type</th>
                <th class="dt-head-center">Propiedades</th>
                <th class="dt-head-center">Fecha de Creación</th>                               
            </tr>
        </tfoot>
        <tbody>
           
     

        @foreach($activity as $actividad)
            <tr>              
                <td class="dt-body-center">{{$actividad->id}}</td>
                <td class="dt-body-center">{{$actividad->log_name}}</td>
                <td class="dt-body-center">{{$actividad->description}}</td> 
                <td class="dt-body-center">{{$actividad->subject_id}}</td>
                <td class="dt-body-center">{{$actividad->subject_type}}</td>
                <td class="dt-body-center">{{$actividad->causer_id}}</td>
                <td class="dt-body-center">{{$actividad->causer_type}}</td>
                <td class="dt-body-center">{{$actividad->properties}}</td>
                <td class="dt-body-center">{{$actividad->created_at}}</td>               
            </tr>
            @endforeach        
        </tbody>
    </table>
    </div>
    </div>
</div> 
</div> 
@endsection


