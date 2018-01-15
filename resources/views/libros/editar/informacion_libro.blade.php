
                    <div class="form-group col-md-6">                     
                      <label>Título *</label> 
                       {!!Form::text('titulo',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'200',])!!} 
                    </div>
                    
                    <div class="form-group col-md-6">
                      <label>Facultad *</label>
                      {!!Form::select('facultad_id',$facultades_nombre,$libro->facultad_id,['class'=>'form-control select2','style'=>'width: 100%;','id'=>'facultad_id'])!!}
                    </div>
                     
            
                    @if($flag_ISBN) 
                    <div class="form-group col-md-6">                     
                      <label>ISBN </label> 
                       {!!Form::text('ISBN',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'200',])!!} 
                    </div>
                    @else
                    <div class="form-group col-md-6">                     
                      <label>ISBN </label> 
                       {!!Form::text('inf',"Debe ingresar los documentos de ISBN antes de ingresar el codigo.",['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'200','disabled'=>true])!!} 
                    </div>
                    @endif

                  @if($flag_IEPI) 
                    <div class="form-group col-md-6">                     
                      <label>IEPI </label> 
                       {!!Form::text('IEPI',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'200',])!!} 
                    </div> 
                    @else
                    <div class="form-group col-md-6">                     
                      <label>IEPI </label> 
                       {!!Form::text('inf',"Debe ingresar los documentos de IEPI antes de ingresar el codigo.",['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'200','disabled'=>true])!!} 
                    </div> 
                    @endif
                     

               {{--     <div class="form-group col-md-12">              
                    <button type="button" class="btn btn-link fa fa-plus" id="asignar_autores" data-toggle="modal" data-target="#modal_agregar_autor">Asignar autores*</button>                  
                   </div>     --}}            
                   

                       <div class="form-group col-md-6">
                    <strong>Autores</strong>
                    <button type="button" class="btn btn-link fa fa-plus" id="asignar_autores" data-toggle="modal" data-target="#modal_agregar_autor">Asignar autores*</button> 
                  
                         <ul>
                     @foreach ($libro->autor as $name)                    
                     <li>{{$name->nombre}} {{$name->apellido}}</li>
               

                      @endforeach       
                      </ul>
                     </div>
                     
                  <div class="form-group col-md-6">               
                      <label>Colección *</label>
                      <select id="coleccion_id"  class="form-control select2" name="coleccion_id">
                        <option value='null'> Seleccionar Colección </option>
                       @foreach($colecciones as $coleccion)
                        <option value="{{ $coleccion->id }}" @if($coleccion->id == $libro->coleccion->id) selected @endif> {{ $coleccion->titulo }} </option>
                       @endforeach
                      </select>
           
                    </div>


                    <div class = "espacio col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"></div>  
            

                    @if($libro->capitulos->count() > 0)  
                    <div class="form-group col-md-12">
                    <strong>Capítulos</strong>{!!link_to_route('libro.agregarcapitulos', $title = "Editar capitulos", $parameters = $libro->id, $attributes = ['class'=>"btn btn-link fa fa-plus"])!!}       
                    </div>    
                     <div class="col-md-12">
                     <table id="example1" class="table table-striped table-bordered display compact consultarCapitulo" cellspacing="0" width="100%">
        <thead>
            <tr>
                 
                <th class="dt-head-center">ID</th>
                <th class="dt-head-center">Título</th>
                <th class="dt-head-center">Descripción</th>
                <th class="dt-head-center">Autores</th>   
            </tr>
        </thead>  
        <tbody>
        
                @foreach ($libro->capitulos as $capitulos)
              
            <tr>
                <td class="dt-body-center">{{$capitulos->id}}</td>
                <td class="dt-body-center">{{$capitulos->titulo}}</td>
                <td class="dt-body-center">{{$capitulos->descripcion}}</td>
                 <td class="dt-body-center">                 
                  @foreach ($capitulos->autor as $autor)
                    <p>  {{$autor->nombre}} {{$autor->apellido}} </p>
                  @endforeach 
                </td>            
            </tr>
              @endforeach
        </tbody>
      </table>
      </div>

      @else
      <div class="form-group col-md-12">
        <label>Capítulos</label>
        <p> No se ha ingresado ningún capitulo.
            {!!link_to_route('libro.agregarcapitulos', $title = "Agregar capitulos", $parameters = $libro->id, $attributes = ['class'=>"btn btn-link fa fa-plus"])!!}
       </p>       
      </div>

     @endif
               
     <div class="fondo_formulario box-footer col-md-12">
                    <a type="button" href="{{route('libro.index')}}" class="btn btn-primary fa fa-arrow-left"></a>
                    <button type="submit" class="btn btn-primary">Grabar</button>
                  </div> 