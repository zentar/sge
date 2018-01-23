<table style="width:100%;">
<tr>
<td><img src={{public_path('logoNormal.png')}} style="width:160; height:45; align:left;" alt="logo_publicaciones"></td>

<td><img src={{public_path('LogoUCSG.png')}} style="width:113; height:56;" align="right" alt="logo_UCSG"></td>
</tr>
</table>
<br>
<table width="100%">
<tr>
    <td style="text-align:center;width:50%;" >
    <div><p align="left">Guayaquil, {{$fecha}}</p></div><div class="col-md-6"></div>
    </td>
    <td style="text-align:center;width:50%;" >
    <div><p align="right">No 001</p></div>
    </td>   
    </tr>
  </table>
<div class="row col-md-12">      
       <p style="font-weight: bold;" align="center">PRODUCCIÓN DE LA OBRA:</p>
</div>
<div class="row col-md-12">      
       <p style="font-weight: bold;" align="center">{{$libro->titulo}}</p>
</div>

<div class="row col-md-12">      
       <p align="left">Cotización solicitada de acuerdo a las siguientes carácteristicas:</p>
</div>

<div class="row col-md-12">      
       <div align="left"><label style="font-weight: bold;">Título: </label>{{$libro->titulo}}</div>
</div>
<div class="row col-md-12">      
<div align="left"><label style="font-weight: bold;">Autores: </label>  @foreach ($libro->autor as $name) 
                {{$name->nombre}} {{$name->apellido}}                
                @if($name == $libro->autor->last())
                {{"."}} 
                @else
                 {{","}} 
                @endif  
                @endforeach  </div>
</div>
<div class="row col-md-12">      
       <div align="left"><label style="font-weight: bold;">Tamaño: </label>{{$libro->caracteristicas->tamanopapel->descripcion}}</div>
</div>
<div class="row col-md-12">      
       <div align="left"><label style="font-weight: bold;">Papel: </label>{{$libro->caracteristicas->tipopapel->descripcion}}</div>
</div>
<div class="row col-md-12">      
       <div align="left"><label style="font-weight: bold;">Número de páginas: </label>{{$libro->caracteristicas->n_paginas}}</div>
</div>
<div class="row col-md-12">      
       <div align="left"><label style="font-weight: bold;">Color: </label>{{$libro->caracteristicas->colorpapel->descripcion}}</div>
</div>
<div class="row col-md-12">      
       <div align="left"><label style="font-weight: bold;">Cubierta: </label>{{$libro->caracteristicas->cubierta}}</div>
</div>
<div class="row col-md-12">      
       <div align="left"><label style="font-weight: bold;">Solapas: </label>{{$libro->caracteristicas->solapas}}</div>
</div>
<br>
<table class="table table-striped table-bordered display compact cotizaciones" style=" border-collapse: collapse;" border="1" width="100%">
        <thead>
            <tr> 
                <th align="center">Imprenta</th>
                <th align="center">Tiraje</th>
                <th align="center">Valor ($)</th>
                <th align="center">Total ($)</th>
                <th align="center">  </th>
            </tr>
        </thead>
       
        <tbody>
      
          @foreach($cotizaciones as $cotizacion)
           <tr>     
                <td  style="text-align:center;width:30%;">{{$cotizacion->imprenta}}</td>
                <td  style="text-align:center;width:15%;">{{$cotizacion->tiraje}} ejemplares</td>
                <td  style="text-align:center;width:15%;">$ {{$cotizacion->valor}}</td>  
                <td  style="text-align:center;width:15%;">$ {{$cotizacion->total}}</td> 
                <td  style="text-align:center;width:25%;"></td>              
              </tr>
          @endforeach
        </tbody>
      </table>
<br>
<div class="row col-md-12">      
       <div align="left"><label  style="font-weight: bold;">Observaciones:</label></div>
</div>
<br>
<div class="row col-md-12">      
       <div align="left">Considerando la calidad del material, tiempo de entrega, acabados, se selecciona a la Empresa _________________________________________</div>
</div>

<table width="100%">
<tr>
    <td style="text-align:center;width:33%;" >
    <div><p>Tramitado por:</p></div>
    </td>
    <td style="text-align:center;width:33%;" >
    <div><p>Vto. Bno.</p></div>
    </td>
    <td style="text-align:center;width:33%;" >
    <div><p>Autorizado</p></div>
    </td>
    </tr>
  </table>
  <table width="100%">
<tr>
    <td style="text-align:center;width:33%;" >
    <div><p>_____________	</p></div>
    </td>
    <td style="text-align:center;width:33%;" >
    <div><p>_____________	</p></div>
    </td>
    <td style="text-align:center;width:33%;" >
    <div><p>_____________	</p></div>
    </td>
    </tr>
  </table>  
<br>
<div class="row col-md-12">      
       <div align="left">Se adjunta (5) copia(s) de cotizaciones.</div>
</div>
<div class="row col-md-12">      
       <div align="left">SO. Trabajo #..........</div>
</div>
<br>
<div class="row col-md-12"> 
<p style="font-size: 80%" align="center">Av .C.J. Arosemena Km. 1,5 Edificio principal, segundo piso. Apartado postal 09-01-4671 Guayaquil – Ecuador    Telefax: 593-04-2209210 Ext. 2634 Correo electrónico: roberto.garcia02@cu.ucsg.edu.ec </p>    
</div>

 
   










      


      
