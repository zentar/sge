
                    <div class="form-group col-md-12">                     
                      <label>Título *</label> 
                       {!!Form::text('titulo',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'200',])!!} 
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
                    <label>Autores *</label>
                     <div class="panel-body">
                     <div class="form-group col-md-6">        
                      {!!Form::select('autores',$autores_nombre,null,['class'=>'form-control select2','style'=>'width: 100%;','id'=>'autores'])!!}
                     </div>

                    <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                     <div class="form-group  col-xs-12 col-sm-6 col-md-6 col-lg-2">
                     <button type="button" class="btn btn-primary col-sm-12 col-md-12 col-lg-12" id="Agregar_autores" onclick="myFunction()">Agregar</button>
                    </div>

                    <div class="form-group  col-xs-12 col-sm-6 col-md-6 col-lg-2">
                     <button type="button" class="btn btn-primary col-sm-12 col-md-12 col-lg-12" id="nuevo_autores" data-toggle="modal" data-target="#modal_autor">Nuevo</button>
                    </div>
                  </div>
                    

                    <div class="form-group" id="demo">  
                    @if (count(old('autor'))>0)                        
                       @foreach (old('autor') as $user)
                      <div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'><input class='form-control col-xs-12 col-sm-12 col-md-12 col-lg-12' maxlength='200' disabled id='autors{{$user}}' type='text' name='text[]' value='{{$autores_nombre[$user]}}'></div><div class='col-xs-12 col-sm-3 col-md-2 col-lg-1'><button type='button' class='btn btn-danger col-xs-2 col-sm-12 col-md-12 col-lg-12' id='autor-{{$user}}' onclick='myFunction2({{$user}})'>Quitar </button></div>
           
                       @endforeach
                       @endif 
                      </div>                   
                     </div>
                 
                   </div>

                    <div style="background-color: #f2f2f2;" class="form-group box-footer col-md-12">
                   <a type="button" href="{{route('libro.index')}}" class="btn btn-primary fa fa-arrow-left"></a>
                    <button type="submit" class="btn btn-primary">Grabar</button>
                  </div>
                   
               