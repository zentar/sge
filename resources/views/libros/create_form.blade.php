
              <div class="form-group">    
                  <label>Título</label>                   
                  {!!Form::text('titulo',null,['class'=>'form-control','placeholder'=>'-','maxlength'=>'200',])!!}                  
              </div>  
                    
                    <div class="form-group">
                      <label>Facultad</label>
                       {!!Form::text('facultad',null,['class'=>'form-control', 
                      'placeholder'=>'-','maxlength'=>'100',])!!}
                    </div>

                    <div class="panel panel-default">
                     <div class="panel-heading">
                       <h3 class="panel-title">Autores</h3>
                     </div>
                     <div class="panel-body">

                     <div class="form-group col-md-6">        
                     {!!Form::select('autores',$autores_nombre,null,['class'=>'form-control select2','style'=>'width: 100%;','id'=>'autores','autofocus'])!!}
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
                    </div>                       
                   
                   </div> </div>

                    <div class="form-group">
                      <label>Revisión de Pares</label>
                        {!!Form::text('revision_pares',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'10',])!!}
                    </div>
                    <div class="form-group">
                      <label>Contrato</label>
                        {!!Form::text('contrato',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'10',])!!}
                    </div>
                    <div class="form-group">
                      <label>ISBN</label>
                        {!!Form::text('isbn',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100',])!!}
                    </div>
                     <div class="form-group">
                      <label>PI</label>
                        {!!Form::text('pi',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100',])!!}
                    </div>
                     <div class="form-group">
                      <label>N paginas</label>
                      {!!Form::text('paginas',null,['class'=>'form-control', 
                      'placeholder'=>'-','maxlength'=>'100',])!!}
                    </div>



    
