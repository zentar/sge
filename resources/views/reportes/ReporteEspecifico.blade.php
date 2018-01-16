
<table border="1">
  <tr>
      <th style="text-align:center;" colspan="2">Información del libro</th>  
  </tr>
	<tr>
		<td><label>Título</label></td> <td style="text-align:center;">{{$libro->titulo}}</td>
	</tr>

	<tr>
		<td><label>Facultad</label></td><td style="text-align:center;">{{$libro->facultad->nombre}}</td>
	</tr>
	<tr>
		<td><label>ISBN</label></td><td style="text-align:center;">{{$libro->ISBN}}</td>
	</tr>
	<tr>
		<td><label>IEPI</label></td><td style="text-align:center;">{{$libro->IEPI}}</td>
	</tr>
	<tr>
		<td><label>Colección</label></td> <td style="text-align:center;">{{$libro->coleccion->titulo}}</td>
	</tr>
	<tr>
		<td><label>Autores</label></td><td style="text-align:center;">{{$autores}}</td>
	</tr>
</table>

<br><br>

<table border="1">
  <tr>
      <th style="text-align:center;" colspan="2">Caracteristicas del libro</th>  
  </tr>
	<tr>
		<td><label>Tipo de papel</label></td> <td style="text-align:center;">{{$libro->caracteristicas->tipopapel->descripcion}}</td>
	</tr>

	<tr>
		<td><label>Tamaño</label></td><td style="text-align:center;">{{$libro->caracteristicas->tamanopapel->descripcion}}</td>
	</tr>
	<tr>
		<td><label>Número de páginas</label></td><td style="text-align:center;">{{$libro->caracteristicas->n_paginas}}</td>
	</tr>
	<tr>
		<td><label>Color</label></td><td style="text-align:center;">{{$libro->caracteristicas->colorpapel->descripcion}}</td>
	</tr>
	<tr>
		<td><label>Cubierta</label></td> <td style="text-align:center;">{{$libro->caracteristicas->cubierta}}</td>
	</tr>
	<tr>
		<td><label>Solapa</label></td><td style="text-align:center;">{{$libro->caracteristicas->solapas}}</td>
	</tr>

	<tr>
		<td><label>Observaciones</label></td><td style="text-align:center;">{{$libro->caracteristicas->observaciones}}</td>
	</tr>
</table>

<br><br>
@if(count($libro->cotizacion)>0)
<table border="1">
  <tr>
      <th style="text-align:center;" colspan="2">Cotizaciones del libro</th>  
  </tr>
  @foreach($libro->cotizacion as $cotizacion)
  	<tr>
		<th style="text-align:center;" colspan="2">Cotizacion {{$loop->index+1}} </th>
	</tr>

	<tr>
		<td><label>Imprenta</label></td> <td style="text-align:center;">{{$cotizacion->imprenta}}</td>
	</tr>

	<tr>
		<td><label>Tiraje</label></td><td style="text-align:right;">{{$cotizacion->tiraje}}</td>
	</tr>
	<tr>
		<td><label>Valor</label></td><td style="text-align:right;">${{$cotizacion->valor}}</td>
	</tr>
	<tr>
		<td><label>Total</label></td><td style="text-align:right;">${{$cotizacion->total}}</td>
	</tr>	
  @endforeach	
</table>
@endif



