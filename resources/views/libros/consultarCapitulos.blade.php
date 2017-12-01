@extends('layouts.app')
@section('content')
   

     @foreach($libro as $libro)

     
       <h3> {{$libro->titulo}} </h3>
          @foreach($capitulos as $capitulo)
             @if($capitulo->book_id == $libro->id) 
                        <h4>  {{$capitulo->titulo}} </h4>
                        <strong>  {{$capitulo->descripcion}}</strong>

                           @foreach($autorcapitulos as $autorcap)
             @if($capitulo->id == $autorcap->capitulos_id)

                   @foreach($autores as $autor)   
                    @if($autorcap->autor_id == $autor->id) 
                   <p> {{$autor->nombre}} {{$autor->apellido}}</p>
                   @endif
                   @endforeach 
             @endif
             @endforeach
             @endif


          
          @endforeach


     @endforeach 










@stop