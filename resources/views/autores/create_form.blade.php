
                    <div class="form-group col-md-6">                     
                      <label>Cedula</label> 
                       {!!Form::text('cedula',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'10','tabindex'=>'1'])!!} 
                    </div>
                    <div class="form-group col-md-6">
                      <label>Nombre</label>
                      {!!Form::text('nombre',null,['class'=>'form-control', 
                      'placeholder'=>'-','maxlength'=>'85','tabindex'=>'2'])!!}
                    </div>
                    <div class="form-group col-md-6">
                      <label>Apellido</label>
                       {!!Form::text('apellido',null,['class'=>'form-control', 
                      'placeholder'=>'-','maxlength'=>'85','tabindex'=>'3'])!!}
                    </div>
                    <div class="form-group col-md-6">
                      <label>Email</label>
                        {!!Form::text('email',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100','tabindex'=>'4'])!!}
                    </div>
                    <div class="form-group col-md-6">
                      <label>Teléfono</label>
                        {!!Form::text('telefono',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'7','tabindex'=>'5'])!!}
                    </div>
                    <div class="form-group col-md-6">
                      <label>Filiaciones</label>
                        {!!Form::text('filiacion',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100','tabindex'=>'6'])!!}
                    </div>
                