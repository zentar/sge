                  @can('libro_edit_informacion_accion')
                    <div class="form-group col-md-6">                     
                      <label>Título *</label> 
                        {!!Form::text('titulo',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'200',])!!}
                    </div>
                    @else
                    <div class="form-group col-md-6">                     
                      <label>Título *</label> 
                        {!!Form::text('titulo',$libro->titulo,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'200','disabled'])!!}
                    </div>
                    @endcan
                    
                    @can('libro_edit_informacion_accion')
                    <div class="form-group col-md-6">
                      <label>Facultad *</label>
                      {!!Form::select('facultad_id',$facultades_nombre,$libro->facultad_id,['class'=>'form-control select2','style'=>'width: 100%;','id'=>'facultad_id'])!!}
                    </div>
                    @else
                    <div class="form-group col-md-6">
                      <label>Facultad *</label> 
                      {!!Form::select('facultad_id',$facultades_nombre,$libro->facultad_id,['class'=>'form-control select2','style'=>'width: 100%;','id'=>'facultad_id','disabled'=>true])!!}
                    </div>
                    @endcan
                     
                    @can('libro_edit_informacion_accion')
                    @if($flag_ISBN) 
                    <div class="form-group col-md-6">                     
                      <label>ISBN </label> 
                       {!!Form::text('ISBN',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'200',])!!} 
                    </div>
                    @else
                    <div class="form-group col-md-6">                     
                      <label>ISBN </label> 
                       {!!Form::text('inf',"Debe ingresar los documentos de ISBN antes de ingresar el código.",['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'200','disabled'=>true])!!} 
                    </div>
                    @endif                  
                    @else
                    @if($flag_ISBN) 
                    <div class="form-group col-md-6">                     
                      <label>ISBN </label> 
                       {!!Form::text('ISBN',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'200','disabled'])!!} 
                    </div>
                    @else
                    <div class="form-group col-md-6">                     
                      <label>ISBN </label> 
                       {!!Form::text('inf',"Debe ingresar los documentos de ISBN antes de ingresar el código.",['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'200','disabled'=>true])!!} 
                    </div>
                    @endif
                    @endcan
                  
                    @can('libro_edit_informacion_accion')
                  @if($flag_IEPI) 
                    <div class="form-group col-md-6">                     
                      <label>IEPI </label> 
                       {!!Form::text('IEPI',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'200',])!!} 
                    </div> 
                    @else
                    <div class="form-group col-md-6">                     
                      <label>IEPI </label> 
                       {!!Form::text('inf',"Debe ingresar los documentos de IEPI antes de ingresar el código.",['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'200','disabled'=>true])!!} 
                    </div> 
                    @endif
                    @else
                    @if($flag_IEPI) 
                    <div class="form-group col-md-6">                     
                      <label>IEPI </label> 
                       {!!Form::text('IEPI',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'200','disabled'=>true])!!} 
                    </div> 
                    @else
                    <div class="form-group col-md-6">                     
                      <label>IEPI </label> 
                       {!!Form::text('inf',"Debe ingresar los documentos de IEPI antes de ingresar el código.",['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'200','disabled'=>true])!!} 
                    </div> 
                    @endif
                   @endcan

     @can('libro_edit_informacion_accion')
                  <div class="form-group col-md-6">               
                      <label>Colección *</label>
                      <select id="coleccion_id"  class="form-control select2" name="coleccion_id">                    
                       @foreach($colecciones as $coleccion)
                        <option value="{{ $coleccion->id }}" @if($coleccion->id == $libro->coleccion->id) selected @endif> {{ $coleccion->titulo }} </option>
                       @endforeach
                      </select>
           
                    </div>
                    @else
                    <div class="form-group col-md-6">               
                      <label>Colección *</label>
                      <select id="coleccion_id"  class="form-control select2" disabled name="coleccion_id">
                        <option value='null'> {{ $libro->coleccion->titulo }} </option>               
                      </select>           
                    </div>
                    @endcan

     
                   @can('libro_edit_informacion_accion')
                   
                  <div class="form-group col-md-6">               
                      <label>Campo General *</label>
                      <select id="campo_general_id"  class="form-control select2" name="campo_general_id" onchange="cargar_campo_especifico()"> 
                      <option value="null"> Seleccionar Campo General </option>                                         
                       @foreach($campo_general as $campoG)
                        <option value="{{ $campoG->id }}" @if(isset($libro->campogeneral) && $campoG->id == $libro->campogeneral->id) selected @endif>{{ $campoG->codigo }}-{{ $campoG->titulo }} </option>
                       @endforeach
                      </select>
           
                    </div>
                    @else
                    @if($libro->campogeneral != null)
                    <div class="form-group col-md-6">               
                      <label>Campo General *</label>
                      <select id="campo_general_id"  class="form-control select2" disabled name="campo_general_id">
                        <option value='null'> {{ $libro->campogeneral->codigo }}-{{ $libro->campogeneral->titulo }} </option>               
                      </select>           
                    </div>
                    @endif                   
                    @endcan
                


                

                    <div class="form-group col-md-6">
                    <strong>Autores</strong>
                 @can('libro_edit_informacion_accion')   <button type="button" class="btn btn-link fa fa-plus" id="asignar_autores" data-toggle="modal" data-target="#modal_agregar_autor">Asignar autores*</button> @endcan
                  
                         <ul class="col-md-12 list-group">
                     @foreach ($libro->autor as $name)                    
                     <li class="col-md-12 list-group-item" id="autors{{$name->id}}2" type='text' name='text[]' value='"+autor+"2'>{{$name->nombre}} {{$name->apellido}}</li>
                      @endforeach    
                     
                      <div id="demo2" name="demo2">
                      </div> 

                      </ul>
                     </div>
                     
                    
                  @can('libro_edit_informacion_accion')                     
                  <div class="form-group col-md-6">               
                      <label>Campo Especifico *</label>
                      <select id="campo_especifico_id"  class="form-control select2" name="campo_especifico_id" onchange="cargar_campo_detallado()">
                      @if($libro->campogeneral != null)
                      <option value="null"> Seleccionar Campo Específico </option>  
                      @foreach($campo_especifico as $campoG)
                        <option value="{{ $campoG->id }}" @if(isset($libro->campoespecifico) && $campoG->id == $libro->campoespecifico->id) selected @endif>{{ $campoG->codigo }}-{{ $campoG->titulo }} </option>
                       @endforeach 
                       @endif
                      </select>
                    </div>
                    @else
                    @if($libro->campoespecifico != null)
                    <div class="form-group col-md-6">               
                      <label>Campo Especifico *</label>
                      <select id="campo_especifico_id"  class="form-control select2" disabled name="campo_especifico_id">
                        <option value='null'> {{ $libro->campoespecifico->titulo }} </option>               
                      </select>           
                    </div>
                    @endif
                    @endcan

                  @can('libro_edit_informacion_accion')        
                  <div class="form-group col-md-6">               
                      <label>Campo Detallado *</label>
                      <select id="campo_detallado_id"  class="form-control select2" name="campo_detallado_id">
                    
                      @if($libro->campo_especifico != null) 
                      <option value="null"> Seleccionar Campo Detallado </option>                                  
                       @foreach($campo_detallado as $campoDT)
                        <option value="{{ $campoDT->id }}" @if( isset($libro->campodetallado) && $campoDT->id == $libro->campodetallado->id) selected @endif>{{ $campoDT->codigo }}- {{ $campoDT->titulo }} </option>
                       @endforeach
                       @endif
                      </select>           
                    </div>
                    @else
                    @if($libro->campodetallado != null)
                    <div class="form-group col-md-6">               
                      <label>Campo Detallado *</label>
                      <select id="campo_detallado_id"  class="form-control select2" disabled name="campo_detallado_id">
                        <option value='null'> {{ $libro->campodetallado->titulo }} </option>               
                      </select>           
                    </div>
                    @endif  
                    @endcan 
                               
                    
                    
                    @can('libro_edit_informacion_accion')
                   <div class="form-group col-md-6"> 
                        <label>Original:</label>                    
                        {!!Form::File('libro_original')!!} 

                      @if($libro->archivo()->where('tipodoc_id', 20)->count() > 0)             

                      
                @if($libro->archivo()->where('tipodoc_id', 20)->get()->first()->extension=='pdf' || $libro->archivo()->where('tipodoc_id', 20)->get()->first()->extension=='jpeg' ||$libro->archivo()->where('tipodoc_id', 20)->get()->first()->extension=='bmp' || $libro->archivo()->where('tipodoc_id', 20)->get()->first()->extension=='jpg' || $libro->archivo()->where('tipodoc_id', 20)->get()->first()->extension=='png')
                <button type="button" class="btn btn-link" id="nuevo_documento" data-toggle="modal" data-target="#modal_documento" onclick="documentos_modal('{{ $libro->archivo()->where('tipodoc_id', 20)->get()->first()->id}}','{{ $libro->archivo()->where('tipodoc_id', 20)->get()->first()->extension}}','{{$libro->archivo()->where('tipodoc_id', 20)->get()->first()->nombre}}')">{{$libro->archivo()->where('tipodoc_id', 20)->get()->first()->nombre}}</button>
                @else
                {!!link_to_route('image.documentos', $title = $libro->archivo()->where('tipodoc_id', 20)->get()->first()->nombre, $parameters = $libro->archivo()->where('tipodoc_id', 20)->get()->first()->id, $attributes = ['class'=>"btn btn-link"])!!}
           
               @endif  
            
                    
                     @endif 
                     @else
                     <div class="form-group col-md-6"> 
                     @if($libro->archivo()->where('tipodoc_id', 20)->count() > 0) 
                        <label>Original:</label>
                              

                      
@if($libro->archivo()->where('tipodoc_id', 20)->get()->first()->extension=='pdf' || $libro->archivo()->where('tipodoc_id', 20)->get()->first()->extension=='jpeg' ||$libro->archivo()->where('tipodoc_id', 20)->get()->first()->extension=='bmp' || $libro->archivo()->where('tipodoc_id', 20)->get()->first()->extension=='jpg' || $libro->archivo()->where('tipodoc_id', 20)->get()->first()->extension=='png')
<button type="button" class="btn btn-link" id="nuevo_documento" data-toggle="modal" data-target="#modal_documento" onclick="documentos_modal('{{ $libro->archivo()->where('tipodoc_id', 20)->get()->first()->id}}','{{ $libro->archivo()->where('tipodoc_id', 20)->get()->first()->extension}}','{{$libro->archivo()->where('tipodoc_id', 20)->get()->first()->nombre}}')">{{$libro->archivo()->where('tipodoc_id', 20)->get()->first()->nombre}}</button>
@else
{!!link_to_route('image.documentos', $title = $libro->archivo()->where('tipodoc_id', 20)->get()->first()->nombre, $parameters = $libro->archivo()->where('tipodoc_id', 20)->get()->first()->id, $attributes = ['class'=>"btn btn-link"])!!}

@endif  

    
     @endif 

                     @endcan                
                     </div>


                     <div class = "espacio2 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"></div>
            
                    @if($libro->capitulos->count() > 0)  
                    <div class="form-group col-md-12">
                    <strong>Capítulos</strong> @can('libro_edit_informacion_accion') {!!link_to_route('libro.agregarcapitulos', $title = "Editar capitulos", $parameters = $libro->id, $attributes = ['class'=>"btn btn-link fa fa-plus"])!!}  @endcan     
                    </div>    
                     <div class="col-md-12">
                     <table id="example1" class="table table-striped table-bordered display compact consultarCapitulo" cellspacing="0" width="100%">
        <thead>
            <tr>                
            
                <th class="dt-head-center">Título</th>
              
                <th class="dt-head-center">Autores</th>   
                <th class="dt-head-center">Descripción</th>
            </tr>
        </thead>  
        <tbody>
        
                @foreach ($libro->capitulos as $capitulos)
              
            <tr>
                <td class="dt-body-left">{{$capitulos->titulo}}</td>
        
                 <td class="dt-body-left">                 
                  @foreach ($capitulos->autor as $autor)
                    <p>  {{$autor->nombre}} {{$autor->apellido}} </p>
                  @endforeach 
                </td>  
                <td class="dt-body-left">{{$capitulos->descripcion}}</td>          
            </tr>
              @endforeach
        </tbody>
      </table>
      </div>

      @else
      <div class="form-group col-md-12">
        <label>Capítulos</label>
        <p> No se ha ingresado ningún capitulo.
         @can('libro_edit_informacion_accion') {!!link_to_route('libro.agregarcapitulos', $title = "Agregar capitulos", $parameters = $libro->id, $attributes = ['class'=>"btn btn-link fa fa-plus"])!!} @endcan
       </p>       
      </div>

     @endif
               
     <div class="fondo_formulario box-footer col-md-12">
              <div class="col-md-6">
                    <a type="button" href="{{route('libro.index')}}" class="btn btn-primary fa fa-arrow-left"></a>
                @can('libro_edit_informacion_accion')    <button type="submit" class="btn btn-primary">Grabar</button> 
</div>
<div align="right" class="col-md-6">

@if($libro->estados_id>1 && \Auth::User()->id == 1) {!!link_to_route('libro.regresarEstado', $title = "Regresar Estado", $parameters = [$libro->id], $attributes = ['class'=>"btn btn-danger fa fa-exclamation-triangle",'onclick'=>'return confirm("¿Esta seguro que desea retroceder estado del libro?")'])!!} @endif

            @if($libro->estados_id<=1){!!link_to_route('libro.solicitudAprobacion', $title = "Solicitud de Aprobación", $parameters = [$libro->id], $attributes = ['class'=>"btn btn-primary fa fa-file-word-o","target"=>"_blank"])!!}@endif @endcan
</div>
</div> 