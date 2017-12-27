@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h1 class="page-title">@lang('quickadmin.roles.title')</h1>
    @can('role_create')
    <p>
        <a href="{{ route('admin.roles.create') }}" class="btn btn-success">Nuevo</a>        
    </p>
    @endcan

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped roles">
                <thead>
                    <tr>
                        <th class="dt-head-center">@lang('quickadmin.roles.fields.title')</th>
                                                <th class="dt-head-center">&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($roles) > 0)
                        @foreach ($roles as $role)
                            <tr data-entry-id="{{ $role->id }}">                             

                                <td  class="dt-body-center">{{ $role->title }}</td>
                                <td  class="dt-body-center">
                                    @can('role_view')
                                    <a href="{{ route('admin.roles.show',[$role->id]) }}" class="btn btn-primary fa fa-eye"></a>
                                    @endcan
                                    @can('role_edit')
                                    <a href="{{ route('admin.roles.edit',[$role->id]) }}" class="btn btn-primary btn-warning btn-md fa fa-pencil-square-o"></a>
                                    @endcan
                                    @can('role_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.roles.destroy', $role->id])) !!}  
                                        <button type="submit" class="btn btn-danger btn-md fa fa-trash-o"></button>
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

@stop
