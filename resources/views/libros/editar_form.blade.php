
                    <div class="form-group">                     
                      <label>Título</label> 
                       {!!Form::text('titulo',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'200',])!!} 
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
                      {!!Form::select('autores',$autores_nombre,null,['class'=>'form-control select2','style'=>'width: 100%;','id'=>'autores','autofocus'])!!}
                     </div>

                     <div class="form-group col-md-6">
                     <button type="button" class="btn btn-primary" id="Agregar_autores" onclick="myFunction()">Agregar</button>
                    </div>

                     <div class="form-group col-md-8" id="demo">
                      @foreach ($libro->autor as $name)

                      <input class='col-md-6' maxlength='200' disabled id='autors{{$name->id}}' type='text' name='text[]' value='{{$name->nombre}} {{$name->apellido}}'>

                      <button type='button' class='btn-danger col-md-1' id='autor-{{$name->id}}' onclick='myFunction2({{$name->id}})'>Quitar </button>
                      @endforeach
                      </div>                   
                     </div>
                   </div>          

           
                    <div class="form-group">
                      <label>Facultad</label>
                       {!!Form::text('facultad',null,['class'=>'form-control', 
                      'placeholder'=>'-','maxlength'=>'100',])!!}
                    </div>
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


