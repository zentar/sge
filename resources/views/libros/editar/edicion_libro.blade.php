{!!Form::close()!!}  

@can('libro_edit_asignaciones')

@if($libro->asignado == 0 && $libro->estados_id == 2)

{!!Form::open(['route'=>'libro.asignar','method'=>'POST', 'id'=>"asignar_editor_libro",'name'=>"asignar_editor_libro"])!!}
{{ Form::hidden('libro_id', $libro->id) }}
{{ Form::hidden('tipo', "edicion") }}

<div class="row col-md-12">
        <div class=" form-group col-md-12">

              <div class="form-group col-md-12">                     
                      <label>Asignar Editor para este libro:</label> 
                     <select id="editor_id" style="width: 100%" class="form-control select2" name="editor_id">                  
                     @foreach($editores as $editor)
                      <option value="{{ $editor->id }}"> {{ $editor->name }} </option>
                     @endforeach
                    </select>
                    </div>

<div class="col-md-12">
 <button type="submit" class="btn btn-primary" onclick="return confirm('¿Seguro de asignar este editor?')" >Asignar</button>
</div>

</div></div>
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


@if($libro->estados_id == 3)
{!!Form::open(['route'=>'libro.cierreEdicion','method'=>'POST', 'id'=>"libro_cierre_edicion",'name'=>"libro_cierre_edicion"])!!}
{{ Form::hidden('libro_id', $libro->id) }}

<div class="col-md-12">
 <button type="submit" class="btn btn-primary" onclick="return confirm('¿Seguro que desa cerrar la edición de este libro?')" >Cerrar Edición</button>
</div>
{!!Form::close()!!} 
@endif