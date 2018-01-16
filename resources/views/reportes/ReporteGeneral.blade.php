      <div class="row container-fluid ">
      <div class="box-body table-responsive">

      <div class="panel-body">
            <table style=" border-collapse: collapse;" border="1" width="100%">
        <thead>
            <tr>
                <th style="text-align:center;" colspan="6">Libros</th>
            </tr>
            <tr>                 
                <th style="text-align:center;">ID</th>
                <th style="text-align:center;">Título</th>
                <th style="text-align:center;">Autores</th>
                <th style="text-align:center;">ISBN</th>
                <th style="text-align:center;">IEPI</th>
                
                <th style="text-align:center;">Estado</th>              
            </tr>
        </thead>
        <tbody>
           @foreach($libros as $libro)
            <tr>
              
                <td class="dt-body-center">{{$libro->id}}</td>
                <td>{{$libro->titulo}}</td>

                <!-- LAZO DE RELACION MUCHO A MUCHOS LIBRO - AUTOR-->
                <td class="dt-body-center">
                @foreach ($libro->autor as $name) 
                {{$name->nombre}} {{$name->apellido}}                
                @if($name == $libro->autor->last())
                {{"."}} 
                @else
                 {{","}} 
                @endif  
                @endforeach  
                </td> 

                <td style="text-align:center;">{{$libro->ISBN}}</td> 

                <td style="text-align:center;">{{$libro->IEPI}}</td> 

               
                
                <td style="text-align:center;">{{$libro->estados->nombre}}</td> 

                 
            </tr>
            @endforeach        
        </tbody>
    </table>
    </div>
    </div>
</div> 
</div> 





