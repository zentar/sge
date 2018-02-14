
                    <div class="form-group col-md-6">
                      <label>Facultad</label>
                       {!!Form::text('facultad',$libro->facultad->nombre,['class'=>'form-control', 
                      'placeholder'=>'-','maxlength'=>'100','disabled'])!!}
                    </div>               

                    <div class="form-group col-md-6">
                      <label>Estado</label>
                        {!!Form::text('estado_id',$libro->estados->nombre,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100','disabled'])!!}
                    </div>

                    <div class="form-group col-md-6">
                      <label>Autores</label>
                    @foreach ($libro->autor as $name)
                    <input class="form-control col-md" placeholder="-" maxlength="10" disabled="" name="revision_pares" type="text" value="{{$name->nombre}} {{$name->apellido}}">
                     @endforeach
                    </div>                           
                    
                   

                    <div class="form-group col-md-6">
                      <label>Coleccion</label>
                        {!!Form::text('coleccion_id',$libro->coleccion->titulo,['class'=>'form-control',
                      'placeholder'=>'-','maxlength'=>'100','disabled'])!!}
                    </div>

                    @if($libro->capitulos->count() > 0)  
                    <div class="form-group col-md-12">
                       <label>Capítulos</label>
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
             @if($libro->capitulos->count() > 0)  
                @foreach ($libro->capitulos as $capitulos)              
            <tr>
                <td class="dt-body-center">{{$capitulos->id}}</td>
                <td class="dt-body-center">{{$capitulos->titulo}}</td>
                <td class="dt-body-center">{{$capitulos->descripcion}}</td>
                 <td class="dt-body-center">                 
                  @foreach ($capitulos->autor as $autor)
                   <p>{{$autor->nombre}} {{$autor->apellido}}</p>
                  @endforeach 
                </td>            
            </tr>
              @endforeach
                @endif
        </tbody>
      </table>
      </div>  
             @endif
                  

