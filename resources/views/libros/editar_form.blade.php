
                    <div class="form-group">                     
                      <label>Título</label> 
                       {!!Form::text('titulo',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'200',])!!} 
                    </div>

                    <div class="form-group">
                      <label>Facultad</label>
                      {!!Form::select('facultad_id',$facultades_nombre,$libro->facultad_id,['class'=>'form-control select2','style'=>'width: 100%;','id'=>'facultad_id'])!!}
                    </div>
               <!--<div class="form-group">
                      <label>Autores</label>
                    @foreach ($libro->autor as $name)
                    <input class="form-control" placeholder="-" disabled="" name="autores" type="text" value="{{$name->nombre}} {{$name->apellido}}">
                     @endforeach
                    </div>-->      


                     <div class="panel panel-default">
                     <div class="panel-heading">
                       <h3 class="panel-title">Autores</h3>
                     </div>
                     <div class="panel-body">

                     <div class="form-group col-md-6">        
                      {!!Form::select('autores',$autores_nombre,null,['class'=>'form-control select2','style'=>'width: 100%;','id'=>'autores'])!!}
                     </div>

                    <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                     <div class="form-group  col-xs-12 col-sm-6 col-md-6 col-lg-2">
                     <button type="button" class="btn btn-primary col-sm-12 col-md-12 col-lg-12" id="Agregar_autores" onclick="myFunction()">Agregar</button>
                    </div>

                    <div class="form-group  col-xs-12 col-sm-6 col-md-6 col-lg-2">
                     <button type="button" class="btn btn-primary col-sm-12 col-md-12 col-lg-12" id="nuevo_autores" data-toggle="modal" data-target=".bd-example-modal-lg">Nuevo</button>
                    </div>
                  </div>
                    
                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12" id="demo">                 
                      @foreach ($libro->autor as $name)                    

                      <div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'><input class='form-control col-xs-12 col-sm-12 col-md-12 col-lg-12' maxlength='200' disabled id='autors{{$name->id}}' type='text' name='text[]' value='{{$name->nombre}} {{$name->apellido}}'></div><div class='col-xs-12 col-sm-3 col-md-2 col-lg-1'><button type='button' class='btn btn-danger col-xs-2 col-sm-12 col-md-12 col-lg-12' id='autor-{{$name->id}}' onclick='myFunction2({{$name->id}})'>Quitar </button></div>
                      
                      @endforeach
                      </div>                   
                     </div>
                   </div> 
                   
                    <div class="form-group ">
                      <label>Revisión de Pares</label>
                        {!!Form::text('revision_pares',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'10',])!!}
                    </div>
                    <div class="form-group ">
                      <label>Contrato</label>
                        {!!Form::text('contrato',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'10',])!!}
                    </div>
                    <div class="form-group ">
                      <label>ISBN</label>
                        {!!Form::text('isbn',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100',])!!}
                    </div>
                     <div class="form-group ">
                      <label>PI</label>
                        {!!Form::text('pi',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100',])!!}
                    </div>
                     <div class="form-group ">
                      <label>N paginas</label>
                      {!!Form::text('paginas',null,['class'=>'form-control', 
                      'placeholder'=>'-','maxlength'=>'100',])!!}
                    </div>

                    <div class="form-group">
                      <label>Colección</label>
                      <select id="coleccion_id" style="width: 100%" class="form-control" name="coleccion_id">
                        <option value='null'> Seleccionar Colección </option>
                       @foreach($colecciones as $coleccion)
                        <option value="{{ $coleccion->id }}" @if($coleccion->id == $libro->coleccion->id) selected @endif> {{ $coleccion->titulo }} </option>
                       @endforeach
                      </select>
                    </div> 
                    

                     @if($libro->capitulos->count() > 0)  
                    <div class="form-group col-md-12">
                       <strong>Capítulos</strong>{!!link_to_route('libro.agregarcapitulos', $title = "Editar capitulos", $parameters = $libro->id, $attributes = ['class'=>"btn btn-link fa fa-plus"])!!}       
                     </div>
                    @foreach ($libro->capitulos as $capitulos)
                    <div class="form-group panel panel-default col-md-6">
                      <ul>
                    <li> {{$capitulos->titulo}}</li>
                    <strong>{{$capitulos->descripcion}}</strong>
                             <ul>
                                  @foreach ($capitulos->autor as $autor)
                                 <p>{{$autor->nombre}} {{$autor->apellido}}</p>
                                 @endforeach 
                             </ul>

                  </ul>
                    </div>                      
                     @endforeach

                     @else
                     <div class="form-group col-md-12">
                       <label>Capítulos</label>
                       <p> No se ha ingresado ningún capitulo.
                           {!!link_to_route('libro.agregarcapitulos', $title = "Agregar capitulos", $parameters = $libro->id, $attributes = ['class'=>"btn btn-link fa fa-plus"])!!}
                      </p>       
                     </div>

                    @endif