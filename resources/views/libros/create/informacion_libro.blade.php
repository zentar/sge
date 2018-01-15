
                    <div class="form-group col-md-12">                     
                      <label>Título *</label> 
                       {!!Form::text('titulo',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'200','tabindex'=>'1'])!!} 
                    </div>
                    
                    <div class="form-group col-md-12">
                    <div class="form-group">
                      <label>Facultad *</label>              

                      <select id="facultad_id" style="width: 100%" class="form-control select2" name="facultad_id">
                        <option value='null'> Seleccionar Facultad </option>
                       @foreach($facultades as $facultad)
                        <option value="{{ $facultad->id }}" @if(Session::get('facultad_old') == $facultad->id) selected @endif> {{ $facultad->nombre }} </option>
                       @endforeach

                      </select>
                    </div>
                    </div>

                             
                    <div class="form-group  col-md-12">
                      <label>Colección *</label>              

                      <select id="coleccion_id" style="width: 100%" class="form-control select2" name="coleccion_id">
                        <option value='null'> Seleccionar Coleccion </option>
                       @foreach($colecciones as $coleccion)
                        <option value="{{ $coleccion->id }}"> {{ $coleccion->titulo }} </option>
                       @endforeach
                      </select>
                    </div>  

                   <div class="form-group col-md-12">              
                    <button type="button" class="btn btn-link fa fa-plus" id="asignar_autores" data-toggle="modal" data-target="#modal_agregar_autor">Asignar autores*</button>                  
                   </div>

                    <div  class="fondo_formulario form-group box-footer col-md-12">
                   <a type="button" href="{{route('libro.index')}}" class="btn btn-primary fa fa-arrow-left"></a>
                    <button type="submit" class="btn btn-primary">Grabar</button>
                  </div>
                   
               