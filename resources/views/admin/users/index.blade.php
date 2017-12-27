@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h1 class="page-title">@lang('quickadmin.users.title')</h1>
    @can('user_create')
    <p>
        <a href="{{ route('admin.users.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    

    {{--<div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>--}}

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped usuarios">
                <thead>
                    <tr> 
                        <th class="dt-head-center">@lang('quickadmin.users.fields.name')</th>
                        <th class="dt-head-center">@lang('quickadmin.users.fields.email')</th>
                        <th class="dt-head-center">@lang('quickadmin.users.fields.role')</th>
                                                <th class="dt-head-center">&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($users) > 0)
                        @foreach ($users as $user)
                            <tr data-entry-id="{{ $user->id }}">

                                <td class="dt-body-center" field-key='name'>{{ $user->name }}</td>
                                <td class="dt-body-center" field-key='email'>{{ $user->email }}</td>
                                <td class="dt-body-center" field-key='role'>{{ $user->role->title or '' }}</td>
                                                                <td>
                                    @can('user_view')
                                    <a href="{{ route('admin.users.show',[$user->id]) }}" class="btn btn-primary fa fa-eye"></a>
                                    @endcan
                                    @can('user_edit')
                                    <a href="{{ route('admin.users.edit',[$user->id]) }}" class="btn btn-primary btn-warning btn-md fa fa-pencil-square-o"></a>
                                    @endcan
                                    @can('user_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.users.destroy', $user->id])) !!}
                                        <button type="submit" class="btn btn-danger btn-md fa fa-trash-o"></button>
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
   {{-- </div> --}}
@stop

@section('javascript') 
    <script>
        @can('user_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.users.mass_destroy') }}';
        @endcan

    </script>
@endsection