@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.roles.title')</h3>
    <div class="box box-primary">
   <div class="box-body">
    {!! Form::model($role, ['method' => 'PUT', 'route' => ['admin.roles.update', $role->id]]) !!}

 
   
            <div class="row">
                <div class="col-xs-12 form-group">
                <div class="col-xs-12 form-group">
                    {!! Form::label('title', trans('quickadmin.roles.fields.title').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                </div>
                    <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
            </div>
            
    
        <div class="col-xs-12 form-group">
        <a href="{{ route('admin.roles.index') }}" class="btn btn-primary fa fa-arrow-left"></a>
    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-primary']) !!}
    </div>

    </div></div>
    {!! Form::close() !!}
@stop

