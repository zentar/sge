
                    <div class="form-group col-md-6">                     
                      <label>Título *</label> 
                       {!!Form::text('titulo',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'200',])!!} 
                    </div>
                    
                    <div class="form-group col-md-6">
                      <label>Facultad *</label>
                      {!!Form::select('facultad_id',$facultades_nombre,$libro->facultad_id,['class'=>'form-control select2','style'=>'width: 100%;','id'=>'facultad_id'])!!}
                    </div>


                    <div class="form-group col-md-12">
                    <label>Autores *</label>
                     <div class="panel-body">
                     <div class="form-group col-md-6">        
                      {!!Form::select('autores',$autores_nombre,null,['class'=>'form-control select2','style'=>'width: 100%;','id'=>'autores'])!!}
                     </div>

                    <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                
                     <button type="button" class="btn btn-primary fa fa-arrow-down" id="Agregar_autores" onclick="myFunction()"></button>
               
                     <button type="button" class="btn btn-success fa fa-plus" id="nuevo_autores" data-toggle="modal" data-target="#modal_autor"></button>
                    
                  </div>
                    

                    <div class="form-group" id="demo">  
                        @foreach ($libro->autor as $name)                    

                      <div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'><input class='form-control col-xs-12 col-sm-12 col-md-12 col-lg-12' maxlength='200' disabled id='autors{{$name->id}}' type='text' name='text[]' value='{{$name->nombre}} {{$name->apellido}}'></div><div class='col-xs-12 col-sm-3 col-md-2 col-lg-1'><button type='button' class='btn btn-danger fa fa-minus col-xs-2 col-sm-12 col-md-12 col-lg-6' id='autor-{{$name->id}}' onclick='myFunction2({{$name->id}})'></button></div>
                      
                      @endforeach
                      </div>                   
                     </div>
                 
                   </div>                    
                   
                  <div class="row col-md-12">
                    <div class="form-group col-md-6">
                      <label>Colección *</label>
                      <select id="coleccion_id" style="width: 100%" class="form-control select2" name="coleccion_id">
                        <option value='null'> Seleccionar Colección </option>
                       @foreach($colecciones as $coleccion)
                        <option value="{{ $coleccion->id }}" @if($coleccion->id == $libro->coleccion->id) selected @endif> {{ $coleccion->titulo }} </option>
                       @endforeach
                      </select>
                    </div> 
                    </div>

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