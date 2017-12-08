<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
  
    use SoftDeletes;

    protected $table = 'books';

    const CREATED_AT = 'created_at';
	
	  const UPDATED_AT = 'updated_at';

	  const DELETED_AT = 'deleted_at';

	  protected $primaryKey = 'id';

    protected $softDelete = true;

    protected $dates = ['deleted_at'];

    protected $fillable = ['titulo','facultad_id','revision_pares','contrato','isbn','pi','paginas','estados_id'];


    public function autor()
    {
        return $this->belongsToMany('App\Autor','autorbook');
    }

    public function facultad()
    {
        return $this->belongsTo('App\Facultad');
    }

    public function capitulos()
    {
         return $this->hasMany('App\Capitulos');
    }

    public function estados()
    {
         return $this->belongsTo('App\Estados');
    }
    
}
