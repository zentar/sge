@extends('layouts.app')

@section('content')
    <h3 class="page-title">Consultar Usuario</h3>

    <div class="box box-primary">
           <div class="box-body"> 

                   <div class="row">
                    <div class="form-group col-md-6">                     
                      <label>@lang('quickadmin.users.fields.name')</label>
                    {!!Form::text('nombre',$user->name,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100','disabled'=>'true'])!!}                 
                    </div> </div>

                    <div class="row">
                    <div class="form-group col-md-6">                     
                      <label>@lang('quickadmin.users.fields.email')</label>
                    {!!Form::text('email',$user->email,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100','disabled'=>'true'])!!}                 
                    </div> </div>

                    <div class="row">
                    <div class="form-group col-md-6">                     
                      <label>@lang('quickadmin.users.fields.role')</label>
                      <input class="form-control" placeholder="-" maxlength="100" disabled="true" name="nombre" value={{ $user->role->title or '' }} type="text">                
                    </div> 
                     </div>

                     <div class="row">
                     <div class="form-group col-md-12">    
                     <a href="{{ route('admin.users.index') }}" class="btn btn-primary fa fa-arrow-left"></a>
                     </div> </div>
        </div>
    </div>
    </div>
@stop
