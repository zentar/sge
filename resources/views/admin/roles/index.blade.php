@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h1 class="page-title">@lang('quickadmin.roles.title')</h1>
    @can('role_create')
    <p>
        <a href="{{ route('admin.roles.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>        
    </p>
    @endcan

  {{--  <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div> --}}

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($roles) > 0 ? 'datatable' : '' }} @can('role_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('role_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.roles.fields.title')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($roles) > 0)
                        @foreach ($roles as $role)
                            <tr data-entry-id="{{ $role->id }}">
                                @can('role_delete')
                                    <td></td>
                                @endcan

                                <td field-key='title'>{{ $role->title }}</td>
                                                                <td>
                                    @can('role_view')
                                    <a href="{{ route('admin.roles.show',[$role->id]) }}" class="btn btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('role_edit')
                                    <a href="{{ route('admin.roles.edit',[$role->id]) }}" class="btn btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('role_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.roles.destroy', $role->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    {{--</div>--}}



  <!--  AGREGAR DATATABLE COMO OTROS VENTANAS
  <div>
        <h1 class="page-title">Roles</h1>

      <div class="row container-fluid ">
      <div class="box-body table-responsive">
           {!! link_to_route('autor.create', $title = 'Nuevo',$parameters = null ,$attributes = ['class'=>"btn btn-success "] ) !!}</p>         
        <div class="panel-body">
            <table id="table_autores" class="table table-striped table-bordered display compact autores" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="dt-head-center">Id</th>
                <th class="dt-head-center">Rol</th>
                <th class="dt-head-center"></th> 
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th class="dt-head-center">Id</th>
                <th class="dt-head-center">Rol</th>
                <th class="dt-head-center"></th>                
            </tr>
        </tfoot>
        <tbody>
           @foreach($roles as $rol)
            <tr>    
                <td class="dt-body-center">{{$rol->id}}</td>          
                <td class="dt-body-center">{{$rol->title}}</td>     
                <td class="dt-body-center"> 
                 <p>
                {!!link_to_route('admin.roles.show', $title = 'Consultar', $parameters = $rol->id, $attributes = ['class'=>"btn btn-primary "])!!}

                {!!link_to_route('admin.roles.edit', $title = 'Editar', $parameters = $rol->id, $attributes = ['class'=>"btn btn-primary "])!!}
                
                {!!link_to_route('admin.roles.destroy', $title = 'Eliminar', $parameters = $rol->id, $attributes = ['class'=>"btn btn-danger ",'onclick'=>'return confirm("Esta seguro de borrar este registro?")'])!!}
               </p>
                </td>

            </tr>
            @endforeach        
        </tbody>
    </table>
        </div> </div> </div>

    </div>-->
@stop

@section('javascript') 
    <script>
        @can('role_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.roles.mass_destroy') }}';
        @endcan

    </script>
@endsection