{{--MODAL AGREGAR AUTOR A LIBRO--}}
   <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal_agregar_autor"  name="modal_agregar_autor">
   <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" 
          data-dismiss="modal" 
          aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Asignar Autores al Libro</h4>
      </div>
  

      <div class="modal-body">
           <div class="box box-primary">
                <div class="box-body">
                   
      @if (Session::has('message'))
      <div class="alert alert-success">
           <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <p>{{ Session::get('message') }}</p>
      </div>
     @endif     
                    <div class="form-group col-md-12">
                    <label>Autores *</label>
                     <div class="panel-body">
                     <div class="form-group col-md-9">        
                      {!!Form::select('autores',$autores_nombre,null,['class'=>'form-control select2','style'=>'width: 100%;','id'=>'autores'])!!}
                     </div>

                    <div class="form-group col-md-3">
                
                     <button type="button" class="btn btn-primary fa fa-arrow-down" id="Agregar_autores" onclick="myFunction()"></button>
               
                     <button type="button" data-dismiss="modal" class="btn btn-success fa fa-plus" id="nuevo_autores" data-toggle="modal" data-target="#modal_autor"></button>
                    
                  </div>
                    

                    <div class="form-group" id="demo">  
                    @if($nuevo == 1)
                    @if (count(old('autor'))>0)                        
                       @foreach (old('autor') as $user)                     
                      <div class="row col-md-12">
                       <div class='col-xs-8 col-md-9'>
                          <input class='form-control' maxlength='200' disabled id='autors{{$user}}' type='text' name='text[]' value='{{$autores_nombre[$user]}}'>
                       </div>
                       <div class='col-xs-4 col-md-3'>
                          <button type='button' class=' btn btn-danger fa fa-minus' id='autor-{{$user}}' onclick='myFunction2({{$user}})'>
                          </button>
                       </div>
                    </div> 
                       @endforeach
                       @endif
                      @endif

                      @if($nuevo != 1)
                      @foreach ($libro->autor as $name)                    
                      <div class="row col-md-12">
                       <div class='col-xs-8 col-md-9'>
                          <input class='form-control' maxlength='200' disabled id='autors{{$name->id}}' type='text' name='text[]' value='{{$name->nombre}} {{$name->apellido}}'>
                       </div>
                       <div class='col-xs-4 col-md-3'>
                          <button type='button' class=' btn btn-danger fa fa-minus' id='autor-{{$name->id}}' onclick='myFunction2({{$name->id}})'>
                          </button>
                       </div>
                    </div> 

                      @endforeach
                      @endif

                    </div>
                     </div>
                 
                   </div>


                </div><!-- /.box-body -->
              </div><!-- /.box -->

           </div>
           <div class="modal-footer">
           <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      
              {!!Form::close()!!}
        </span>
      </div>
    </div>
   </div>    
</div>