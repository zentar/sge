@extends('layouts.app')
@section('content')
              <div class="box box-primary">
                <div class="box-body">
                  {!!Form::open(['route'=>'libro.store', 'method'=>'POST'])!!}
                   @include('libros/create_form')
                   <div class="box-footer">

                    <button type="submit" class="btn btn-primary">Grabar</button>
                  </div>
                  {!!Form::close()!!}
                </div><!-- /.box-body -->
              </div><!-- /.box -->
               
@stop