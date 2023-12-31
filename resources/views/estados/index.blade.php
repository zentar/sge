@extends('layouts.app')
@section('content')
    <h1 class="page-title">@lang('quickadmin.qa_es_index')</h1>

      <div class="row container-fluid ">
      <div class="box-body table-responsive">
           {!! link_to_route('estados.create', $title = ' Nuevo',$parameters = null ,$attributes = ['class'=>"btn btn-success fa fa-plus"] ) !!}</p>         
        <div class="panel-body">
            <table id="table_estados" class="table table-bordered tabke-striped display compact estados" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="dt-head-center"></th> 
                <th class="dt-head-center">ID</th>
                <th class="dt-head-center">Título</th>
                <th class="dt-head-center">Descripción</th>
              

            </tr>
        </thead>
        <tfoot>
            <tr>
              <th class="dt-head-center"></th>                
                <th class="dt-head-center">ID</th>
                <th class="dt-head-center">Título</th>
                <th class="dt-head-center">Descripción</th>
              
            </tr>
        </tfoot>
        <tbody>
           @foreach($estados as $estado)
            <tr>    
            <td style="vertical-align: middle;" class="dt-body-left" class="dt-body-center"> 
                 <p>
            {{--    {!!link_to_route('estados.show', $title = '', $parameters = $estado->id, $attributes = ['class'=>"btn btn-primary fa fa-eye"])!!} --}}

                {!!link_to_route('estados.edit', $title = '', $parameters = $estado->id, $attributes = ['class'=>"btn btn-warning fa fa-pencil-square-o"])!!}
                
                {{--   {!!link_to_route('estados.destroy', $title = '', $parameters = $estado->id, $attributes = ['class'=>"btn btn-danger fa fa-trash-o",'onclick'=>'return confirm("Esta seguro de borrar este registro?")'])!!} --}}
               </p>
                </td>
                <td style="vertical-align: middle;" class="dt-body-left" class="dt-body-center">{{$estado->id}}</td>          
                <td style="vertical-align: middle;" class="dt-body-left" class="dt-body-center">{{$estado->nombre}}</td>
                <td style="vertical-align: middle;" class="dt-body-left" class="dt-body-center">{{$estado->descripcion}}</td>
            
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
