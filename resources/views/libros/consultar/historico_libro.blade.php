@if(isset($libro->historial) && $libro->historial->count()  > 0)  
    <ol>
      @foreach ($libro->historial as $historial)
      
        <li><h4> {{$historial->descripcion}} -  {{ Carbon\Carbon::parse($historial->created_at)->format('d/m/Y') }}</h4> </li>
         
      @endforeach
     </ol> 
      @else
        <div class="form-group col-md-12">
          <p> No han existido cambios de estados en este libro.</p>       
        </div>
  @endif
  
