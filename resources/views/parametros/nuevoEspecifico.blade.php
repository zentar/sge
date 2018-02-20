@extends('layouts.app')
@section('content')

  <h1 class="page-title">Nuevo Parámetro Especifico: {{$campo_general->titulo}} </h1>

              <div class="box box-primary">
                <div class="box-body">
                  {!!Form::open(['route'=>'parametros.storeEspecifico', 'method'=>'POST'])!!}
                  {{ Form::hidden('campo_general', $campo_general->id) }} 

                   <div class="form-group col-md-6">                     
                      <label>Código</label> 
                       {!!Form::text('codigo',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'6','tabindex'=>'1'])!!} 
                    </div>
                    <div class="form-group col-md-6">
                      <label>Título</label>
                      {!!Form::text('titulo',null,['class'=>'form-control', 
                      'placeholder'=>'-','maxlength'=>'85','tabindex'=>'2'])!!}
                    </div>
                   
                   <div class="box-footer col-md-12">
                   <a type="button" href="{{route('parametros.edit', ['id' => $campo_general->id])}}" class="btn btn-primary fa fa-arrow-left"></a>  
                    <button type="submit" class="btn btn-primary">Grabar</button>
                  </div>
                  {!!Form::close()!!}
                </div><!-- /.box-body -->
              </div><!-- /.box -->
               
@stop
                   