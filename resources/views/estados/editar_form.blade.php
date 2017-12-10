                  <div class="form-group col-md-6">                     
                      <label>Nombre</label> 
                       {!!Form::text('nombre',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100'])!!} 
                    </div>
                    <div class="form-group col-md-6">
                      <label>Descripcion</label>
                      {!!Form::text('descripcion',null,['class'=>'form-control', 
                      'placeholder'=>'-','maxlength'=>'100'])!!}
                    </div>