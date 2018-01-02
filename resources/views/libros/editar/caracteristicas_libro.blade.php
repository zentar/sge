                @if(count($libro->caracteristicas) > 0)  
                    <div class="form-group col-md-6">                     
                      <label>Tipo Papel</label> 
                       {!!Form::text('tpapel',$libro->caracteristicas->tpapel,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100'])!!} 
                    </div>

                    <div class="form-group  col-md-6">
                    <label>Tamaño</label>              

                    <select id="tamano" style="width: 100%" class="form-control select2" name="tamano">
                      <option value='null'> Seleccionar tamaño </option>
                     @foreach($tamano_papel as $formato)
                      <option value="{{ $formato->id }}" @if($libro->caracteristicas->tamano == $formato->id) selected @endif > {{ $formato->descripcion }} </option>
                     @endforeach
                    </select>
                  </div>  

                     <div class="form-group col-md-6">                     
                      <label>Número de páginas</label> 
                       {!!Form::text('paginas',$libro->caracteristicas->n_paginas,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100'])!!} 
                    </div>
                     <div class="form-group col-md-6">                     
                      <label>Color</label> 
                       {!!Form::text('color',$libro->caracteristicas->color,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100'])!!} 
                    </div>
                     <div class="form-group col-md-6">                     
                      <label>Cubierta</label> 
                       {!!Form::text('cubierta',$libro->caracteristicas->cubierta,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100'])!!} 
                    </div>
                     <div class="form-group col-md-6">                     
                      <label>Solapa</label> 
                       {!!Form::text('solapa',$libro->caracteristicas->solapas,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100'])!!} 
                    </div>
                     <div class="form-group col-md-12">                     
                      <label>Observaciones</label> 
                       {!!Form::textarea('observaciones',$libro->caracteristicas->observaciones,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'150',"style"=>"overflow:auto;resize:none"])!!} 
                    </div>
                    @else
                    <div class="form-group col-md-6">                     
                      <label>Tamaño</label> 
                       {!!Form::text('tamano',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100'])!!} 
                    </div>
                     <div class="form-group col-md-6">                     
                      <label>Tipo de Papel</label> 
                       {!!Form::text('tpapel',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100'])!!} 
                    </div>
                     <div class="form-group col-md-6">                     
                      <label>Número de páginas</label> 
                       {!!Form::text('paginas',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100'])!!} 
                    </div>
                     <div class="form-group col-md-6">                     
                      <label>Color</label> 
                       {!!Form::text('color',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100'])!!} 
                    </div>
                     <div class="form-group col-md-6">                     
                      <label>Cubierta</label> 
                       {!!Form::text('cubierta',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100'])!!} 
                    </div>
                     <div class="form-group col-md-6">                     
                      <label>Solapa</label> 
                       {!!Form::text('solapa',null,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100'])!!} 
                    </div>
                    <div class="form-group col-md-12">                     
                    <label>Observaciones</label> 
                     {!!Form::textarea('observaciones',$libro->caracteristicas->observaciones,['class'=>'form-control',
                    'placeholder'=>'-','maxlength'=>'150',"style"=>"overflow:auto;resize:none"])!!} 
                    </div>   
                    @endif
                    <div class="box-footer col-md-12">
                    <a type="button" href="{{route('libro.index')}}" class="btn btn-primary fa fa-arrow-left"></a>
                    <button type="submit" class="btn btn-primary">Grabar</button>
                  </div> 