<table style="width:100%;">
<tr>
<td><img src={{public_path('logoNormal.png')}} style="width:160; height:45; align:left;" alt="logo_publicaciones"></td>

<td><img src={{public_path('LogoUCSG.png')}} style="width:113; height:56;" align="right" alt="logo_UCSG"></td>
</tr>
</table>
<br>
<div class="row col-md-12">      
       <div align="left"><label style="font-weight: bold;">Información del Libro</label></div>
</div>

<br>
<div class="row col-md-12">      
       <div align="left"><label style="font-weight: bold;">Título: </label>{{$libro->titulo}}</div>
</div>
<div class="row col-md-12">      
       <div align="left"><label style="font-weight: bold;">Facultad: </label>{{$libro->facultad->nombre}}</div>
</div>
<div class="row col-md-12">      
       <div align="left"><label style="font-weight: bold;">ISBN: </label>{{$libro->ISBN}}</div>
</div>
<div class="row col-md-12">      
       <div align="left"><label style="font-weight: bold;">IEPI: </label>{{$libro->IEPI}}</div>
</div>
<div class="row col-md-12">      
       <div align="left"><label style="font-weight: bold;">Colección: </label>{{$libro->coleccion->titulo}}</div>
</div>
<div class="row col-md-12">      
       <div align="left"><label style="font-weight: bold;">Autores: </label>{{$autores}}</div>
</div>

<br><br>

<div class="row col-md-12">      
       <div align="left"><label style="font-weight: bold;">Características del Libro</label></div>
</div>
<br>
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

<div class="row col-md-12">      
       <div align="left"><label style="font-weight: bold;">Observaciones: </label>{{$libro->caracteristicas->observaciones}}</div>
</div>

<br><br>
@if(count($libro->cotizacion)>0)
<div class="row col-md-12">      
       <div align="left"><label style="font-weight: bold;">Cotizaciones del Libro</label></div>
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
      
          @foreach($libro->cotizacion as $cotizacion)
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
@endif
<br>

@if(count($libro->file)>0)
<div class="row col-md-12">      
       <div align="left"><label style="font-weight: bold;">Documentos ingresados del Libro</label></div>
</div>
<ul>
       @foreach($libro->file as $documentos)
       @if($documentos->tipodoc->id != 23)
	   <li>{{$documentos->tipodoc->nombre}}</li>
	   @endif
       @endforeach
	   </ul>
@endif

@if(count($libro->capitulos)>0)
<div class="row col-md-12">      
       <div align="left"><label style="font-weight: bold;">Capítulos del Libro</label></div>
</div>
<ul>
       @foreach($libro->capitulos as $capitulo)
	   <li>{{$capitulo->titulo}}</li>
	   @endforeach
	   </ul>

@endif


