@extends('layouts.app')
@section('content')
    <h1 class="page-title">@lang('quickadmin.qa_fa_index')</h1>

      <div class="row container-fluid ">
      <div class="box-body table-responsive">
           {!! link_to_route('facultad.create', $title = ' Nuevo',$parameters = null ,$attributes = ['class'=>"btn btn-success fa fa-plus"] ) !!}</p>         
        <div class="panel-body">
            <table id="table_estados" class="table table-bordered tabke-striped display compact facultades" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="dt-head-center">Id</th>
                <th class="dt-head-center">Nombre</th>
                <th class="dt-head-center"></th>
                <th class="dt-head-center"></th>
                <th class="dt-head-center"></th>
                   

            </tr>
        </thead>
        <tfoot>
            <tr>
                <th class="dt-head-center">Id</th>
                <th class="dt-head-center">Nombre</th>
                <th class="dt-head-center"></th>
                <th class="dt-head-center"></th>
                <th class="dt-head-center"></th>
                                
            </tr>
        </tfoot>
        <tbody>
           @foreach($facultades as $facultad)
            <tr>    
                <td width="15%"  style="vertical-align: middle;" class="dt-body-center">{{$facultad->id}}</td>          
                <td width="58%"  style="vertical-align: middle;" class="dt-body-left">{{$facultad->nombre}}</td>
                <td width="9%"  style="vertical-align: middle;" class="dt-body-center"> 
             
                {!!link_to_route('facultad.show', $title = '', $parameters = $facultad->id, $attributes = ['class'=>"btn btn-primary fa fa-eye"])!!}
        
                </td>
                
                <td width="9%"  style="vertical-align: middle;" class="dt-body-center"> 
    
                {!!link_to_route('facultad.edit', $title = '', $parameters = $facultad->id, $attributes = ['class'=>"btn btn-warning fa fa-pencil-square-o"])!!}
        
                </td>
                
                <td width="9%"  style="vertical-align: middle;" class="dt-body-center"> 
              
                {!!link_to_route('facultad.destroy', $title = '', $parameters = $facultad->id, $attributes = ['class'=>"btn btn-danger fa fa-trash-o",'onclick'=>'return confirm("Esta seguro de borrar este registro?")'])!!}
        
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
