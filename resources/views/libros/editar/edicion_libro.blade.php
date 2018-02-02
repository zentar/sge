{!!Form::close()!!}  
<div class="col-md-12">
@can('libro_edit_asignaciones')

@if($libro->asignado == 0 && $libro->estados_id == 2)

{!!Form::open(['route'=>'libro.asignar','method'=>'POST', 'id'=>"asignar_editor_libro",'name'=>"asignar_editor_libro"])!!}
{{ Form::hidden('libro_id', $libro->id) }}
{{ Form::hidden('tipo', "edicion") }}

    <div class="form-group col-md-12">
                 
                     <div class="panel-body">
                     <div class="col-md-12">
                      <label>Asignar Editor para este libro:</label> 
                 </div>
                     <div class="form-group col-md-9"> 
                     <select id="editor_id" style="width: 100%" class="form-control select2" name="editor_id">                  
                     @foreach($editores as $editor)
                      <option value="{{ $editor->id }}"> {{ $editor->name }} </option>
                     @endforeach
                    </select>
                     </div>

                    <div class="form-group col-md-3">                
                    <button type="submit" class="btn btn-primary" onclick="return confirm('¿Seguro de asignar este editor?')" >Asignar</button>    
                  </div>
                </div>
              </div>
@else
  @if($libro->estado_id == 2)
  <h3>Este libro fue asignado ha: {{$editores}}</h3>
  @else
  @if($libro->estado_id > 3)
    <h3>La edición de este libro fue concluido por: {{$editores}}</h3>
    @endif 
  @endif

@endif
{!!Form::close()!!} 
@endcan

      {{--           <div class="form-group col-md-12">
                 
                     <div class="panel-body">
                     <div class="col-md-12">
                      <label>Asignar Editor para este libro:</label> 
                 </div>
                     <div class="form-group col-md-9"> 
                     <select id="editor_id" style="width: 100%" class="form-control select2" name="editor_id">                  
                     @foreach($editores as $editor)
                      <option value="{{ $editor->id }}"> {{ $editor->name }} </option>
                     @endforeach
                    </select>
                     </div>

                    <div class="form-group col-md-3">                
                    <button type="submit" class="btn btn-primary" onclick="return confirm('¿Seguro de asignar este editor?')" >Asignar</button>    
                  </div>
                </div>
              </div> --}}

<div class="container-fluid col-md-12">

  <div class="panel panel-default">
    <div class="panel-heading"><strong>Mensajes:</strong> {{$libro->titulo}}</div>
    <div class="panel-body" style="height:300px; overflow-y:scroll; width:100%;">
    
    @if(count($libro->mensajes)>0)
    @foreach($libro->mensajes as $mensajes)  
    <blockquote>
    <p align="justify" style="line-height:30px;"> {{$mensajes->mensaje}} 
    @if(isset($mensajes->file))      
    @if($mensajes->file->extension=='pdf' || $mensajes->file->extension=='jpeg' ||$mensajes->file->extension=='bmp' || $mensajes->file->extension=='jpg' || $mensajes->file->extension=='png')
                <button type="button" class="btn btn-link" id="nuevo_documento" data-toggle="modal" data-target="#modal_documento" onclick="documentos_modal('{{ $mensajes->file->id}}','{{ $mensajes->file->extension}}','{{$mensajes->file->nombre}}')">{{$mensajes->file->nombre}}</button>
                @else
                {!!link_to_route('image.documentos', $title = '{{$mensajes->file->nombre}}', $parameters = $mensajes->file->id, $attributes = ['class'=>"btn btn-link"])!!}
                @endif    
     @endif  
      </p>
    <footer> {{$mensajes->user->name}} -  {{ Carbon\Carbon::parse($mensajes->created_at)->format('d/m/Y - H:i') }}</footer>
  </blockquote>
    @endforeach
    @else
    <div>
    <h1 align="center">No se han ingresado mensajes</h1>
    </div>
    @endif
    </div>
    <div class="panel-footer">
    @if($libro->estados_id < 3)
     <button type="button" class="btn btn-success" data-toggle="modal" data-target="#edicion_mensajes_modal">Nuevo Mensaje</button>
     @endif
    </div>
  </div>
</div>


@if($libro->estados_id == 3)
{!!Form::open(['route'=>'libro.cierreEdicion','method'=>'POST', 'id'=>"libro_cierre_edicion",'name'=>"libro_cierre_edicion"])!!}
{{ Form::hidden('libro_id', $libro->id) }}

<div align="right" class="form-group col-md-12">
 <button type="submit" class="btn btn-primary fa fa-times-circle" onclick="return confirm('¿Seguro que desa cerrar la edición de este libro?')"> Cerrar Edición</button>
</div>
{!!Form::close()!!} 
@endif

</div>