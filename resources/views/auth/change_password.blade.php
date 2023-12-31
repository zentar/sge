@extends('layouts.app')

@section('content')
	<h3 class="page-title">@lang('quickadmin.qa_change_password')</h3>
    
    <div class="box box-primary">
           <div class="box-body"> 
	@if(session('success'))
		<!-- If password successfully show message -->
		<div class="row">
			<div class="alert alert-success">
				{{ session('success') }}
			</div>
		</div>
	@else
		{!! Form::open(['method' => 'PATCH', 'route' => ['auth.change_password']]) !!}
		<!-- If no success message in flash session show change password form  -->
			<div class="panel-body">
				<div class="row">
					<div class="col-xs-6 form-group">
						{!! Form::label('current_password', trans('quickadmin.qa_current_password'), ['class' => 'control-label']) !!}
						{!! Form::password('current_password', ['class' => 'form-control', 'placeholder' => '']) !!}
						<p class="help-block"></p>
						@if($errors->has('current_password'))
							<p class="help-block">
								{{ $errors->first('current_password') }}
							</p>
						@endif
					</div>
				</div>

				<div class="row">
					<div class="col-xs-6 form-group">
						{!! Form::label('new_password', trans('quickadmin.qa_new_password'), ['class' => 'control-label']) !!}
						{!! Form::password('new_password', ['class' => 'form-control', 'placeholder' => '']) !!}
						<p class="help-block"></p>
						@if($errors->has('new_password'))
							<p class="help-block">
								{{ $errors->first('new_password') }}
							</p>
						@endif
					</div>
				</div>

				<div class="row">
					<div class="col-xs-6 form-group">
						{!! Form::label('new_password_confirmation', trans('quickadmin.qa_password_confirm'), ['class' => 'control-label']) !!}
						{!! Form::password('new_password_confirmation', ['class' => 'form-control', 'placeholder' => '']) !!}
						<p class="help-block"></p>
						@if($errors->has('new_password_confirmation'))
							<p class="help-block">
								{{ $errors->first('new_password_confirmation') }}
							</p>
						@endif
					</div>
				</div>
			</div>
	
        <div class="col-md-6">
		<a href="{{ route('admin.home') }}" class="btn btn-primary fa fa-arrow-left"></a>
		{!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-primary']) !!}
		</div>
		{!! Form::close() !!}
	@endif
	</div></div>
@stop

