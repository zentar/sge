@can('libro_edit_cotizaciones')

@if($libro->asignado == 0 && $libro->estados_id == 4)

{!!Form::open(['route'=>'libro.asignar','method'=>'POST', 'id'=>"asignar_editor_libro",'name'=>"asignar_editor_libro"])!!}
{{ Form::hidden('libro_id', $libro->id) }}
{{ Form::hidden('tipo', "cotizacion") }}

<div class="row col-md-12">
        <div class=" form-group col-md-12">

              <div class="form-group col-md-12">                     
                      <label>Asignar Gestor de producción para este libro:</label> 
                     <select id="gp_id" style="width: 100%" class="form-control select2" name="gp_id">                  
                     @foreach($gestor_p as $gestor)
                      <option value="{{ $gestor->id }}"> {{ $gestor->name }} </option>
                     @endforeach
                    </select>
                    </div>

<div class="col-md-12">
 <button type="submit" class="btn btn-primary" onclick="return confirm('¿Asignar para cotizaciones?')" >Asignar</button>
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