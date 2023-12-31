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
  @if($libro->estados_id == 3)
  <h4>El encargado de la edición de este libro es: {{$editores}}</h4>
  @else
  @if($libro->estados_id > 3)
  <h4>La edición de este libro fue concluido por: {{$editores}}</h4>
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
    <div class="panel-body" style="height:300px; overflow-y:scroll; width:100%;" >
    
    @if(count($libro->mensajes)>0)
    @foreach($libro->mensajes as $mensajes) 

    <blockquote class="col-md-12"
    
     @if($mensajes->user->id ==\Auth::User()->id) 
     
     style="border-style: solid; border-color:black ;background-color: #DCF8C5;  border-radius: 25px;border-width: 0.5px;"
     
     @else 
  style="border-style: solid; border-color:black ;background-color: #FDFDFB;  border-radius: 25px;border-width: 0.5px;"
   
  
  @endif>
   
   
   <div class= @if( Carbon\Carbon::parse($mensajes->created_at)->diffInMinutes() < 5 && $mensajes->user->id ==\Auth::User()->id ) "col-md-10" @else "col-md-12" @endif >
    <p align="justify" style="line-height:30px; overflow-wrap:break-word"> {{$mensajes->mensaje}} 
    @if(isset($mensajes->archivo))      
    @if($mensajes->archivo->extension=='pdf' || $mensajes->archivo->extension=='jpeg' ||$mensajes->archivo->extension=='bmp' || $mensajes->archivo->extension=='jpg' || $mensajes->archivo->extension=='png')
                <button type="button" class="btn btn-link" id="nuevo_documento" data-toggle="modal" data-target="#modal_documento" onclick="documentos_modal('{{ $mensajes->archivo->id}}','{{ $mensajes->archivo->extension}}','{{$mensajes->archivo->nombre}}')">{{$mensajes->archivo->nombre}}</button>
                @else
                {!!link_to_route('image.documentos', $title = '{{$mensajes->archivo->nombre}}', $parameters = $mensajes->archivo->id, $attributes = ['class'=>"btn btn-link"])!!}
                @endif    
     @endif    
     
     </p>
     <footer> {{$mensajes->user->name}} -  {{ Carbon\Carbon::parse($mensajes->created_at)->format('d/m/Y - H:i') }}</footer>
     </div>
   @if( Carbon\Carbon::parse($mensajes->created_at)->diffInMinutes() < 11 && $mensajes->user->id ==\Auth::User()->id ) 
     <div align="center" class="col-md-2 ">
         
      <button type="button" href="" class="btn btn-warning btn-md fa fa-pencil-square-o" onclick="editar_mensaje('{{$mensajes->id}}','{{$mensajes->mensaje}}')"></button>

     {!!link_to_route('libro.mensajedestroy', $title = '', $parameters = [$mensajes->id], $attributes = ['class'=>"btn btn-danger fa fa-trash-o",'onclick'=>'return confirm("¿Esta seguro de borrar este mensaje?")'])!!} 
     </div>
    @endif
    </blockquote> 
    @endforeach
    @else
    <div>
    <h1 align="center">No se han ingresado mensajes</h1>
    </div>
    @endif
    </div>
    <div class="panel-footer">
    @if($libro->estados_id < 4 || \Auth::User()->role->id == 1)
     <button type="button" class="btn btn-success" data-toggle="modal" data-target="#edicion_mensajes_modal" onclick="nuevo_mensaje()" >Nuevo Mensaje</button>
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



