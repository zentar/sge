@if(isset($libro->historial) && $libro->historial->count()  > 0)  
    
      @foreach ($libro->historial as $historial)
      
        <h3>  {{$loop->index+1}} - {{$historial->descripcion}} - {{$historial->created_at}} </h3>
         
      @endforeach
      @else
        <div class="form-group col-md-12">
          <p> No han existido cambios de estados en este libro.</p>       
        </div>
  @endif
  
