
              <div class="form-group">    
                  <label>Título</label>                   
                  {!!Form::text('titulo',Request::old('titulo'),['class'=>'form-control','placeholder'=>'-','maxlength'=>'200',])!!}                  
              </div>

                    <div class="form-group">
                      <label>Facultad</label>
                       {!!Form::select('facultad_id',$facultades_nombre,null,['class'=>'form-control select2','style'=>'width: 100%;','id'=>'facultad_id'])!!}
                    </div>

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
                       @if (count(old('autor'))>0)                        
                       @foreach (old('autor') as $user)
                      <div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'><input class='form-control col-xs-12 col-sm-12 col-md-12 col-lg-12' maxlength='200' disabled id='autors{{$user}}' type='text' name='text[]' value='{{$autores_nombre[$user]}}'></div><div class='col-xs-12 col-sm-3 col-md-2 col-lg-1'><button type='button' class='btn btn-danger col-xs-2 col-sm-12 col-md-12 col-lg-12' id='autor-{{$user}}' onclick='myFunction2({{$user}})'>Quitar </button></div>
           
                       @endforeach
                       @endif
                

                    </div>                       
                   
                   </div> </div>

                    <div class="form-group">
                      <label>Revisión de Pares</label>
                        {!!Form::text('revision_pares',Request::old('revision_pares'),['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'10',])!!}
                    </div>
                    <div class="form-group">
                      <label>Contrato</label>
                        {!!Form::text('contrato',Request::old('contrato'),['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'10',])!!}
                    </div>
                    <div class="form-group">
                      <label>ISBN</label>
                        {!!Form::text('isbn',Request::old('isbn'),['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100',])!!}
                    </div>
                     <div class="form-group">
                      <label>PI</label>
                        {!!Form::text('pi',Request::old('pi'),['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100',])!!}
                    </div>
                     <div class="form-group">
                      <label>N paginas</label>
                      {!!Form::text('paginas',Request::old('paginas'),['class'=>'form-control', 
                      'placeholder'=>'-','maxlength'=>'100',])!!}
                    </div>





    
