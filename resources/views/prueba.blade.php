<h1>Cotizaciones</h1>


<table class="table table-striped table-bordered display compact cotizaciones" style=" border-collapse: collapse;" border="1" width="100%">
        <thead>
            <tr>                 
                <th align="center">ID</th>
                <th align="center">Imprenta</th>
                <th align="center">Tiraje</th>
                <th align="center">Valor</th>
            </tr>
        </thead>
       
        <tbody>
      
          @foreach($cotizaciones as $cotizacion)
           <tr>
                <td align="center">{{$loop->index+1}}</td>
                <td align="center">{{$cotizacion->imprenta}}</td>
                <td align="center">{{$cotizacion->tiraje}}</td>
                <td align="center">{{$cotizacion->valor}}</td>              
              </tr>
          @endforeach
        </tbody>
      </table> 