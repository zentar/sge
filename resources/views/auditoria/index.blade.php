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
                <th class="dt-head-center">Tipo</th>
                <th class="dt-head-center">Acción</th>
                
                <th class="dt-head-center">Descripción</th>
                
                <th class="dt-head-center">Propiedades</th>
                <th class="dt-head-center">Fecha de Creación</th>   
          
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th class="dt-head-center">ID</th>
                <th class="dt-head-center">Tipo</th>
                <th class="dt-head-center">Acción</th>                
                <th class="dt-head-center">Descripción</th>   
                <th class="dt-head-center">Propiedades</th>
                <th class="dt-head-center">Fecha de Creación</th>                               
            </tr>
        </tfoot>
        <tbody>
           
     

        @foreach($activity as $actividad)
            <tr>              
                <td class="dt-body-left">{{$actividad->id}}</td>
                <td class="dt-body-left">{{$actividad->log_name}}</td>
                <td class="dt-body-left">{{$actividad->description}}</td> 
                <td class="dt-body-justify">Se afecto el {{$actividad->subject_type}} {{$actividad->subject_id}}  @if($actividad->causer_type == "App\User") por el usuario con id = {{$actividad->causer_id}} @else   {{$actividad->causer_type}} {{$actividad->causer_id}} @endif
                 </td> 
                <td class="dt-body-left" > @if(isset($actividad->properties['old'])) Actual: {{json_encode($actividad->properties['attributes'])}}<br> Original: {{json_encode($actividad->properties['old'])}} @else {{$actividad->properties}} @endif </td> 
                
               
              
                <td class="dt-body-left">{{$actividad->created_at}}</td>               
            </tr>
            @endforeach        
        </tbody>
    </table>
    </div>
    </div>
</div> 
</div> 
@endsection


