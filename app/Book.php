<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Book extends Model
{
  
    use SoftDeletes;

    use LogsActivity;

    protected $table = 'books';

    const CREATED_AT = 'created_at';
	
    const UPDATED_AT = 'updated_at';

    const DELETED_AT = 'deleted_at';

    protected $primaryKey = 'id';

    protected $softDelete = true;

    protected $dates = ['deleted_at'];

    protected $fillable = ['titulo','facultad_id','revision_pares','contrato','isbn','iepi','paginas','estados_id','coleccion_id'];

    
    protected $attributes = [
        'isbn' => '-',
        'iepi' => '-'
    ];

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
    
    public function coleccion()
    {
        return $this->belongsTo('App\Coleccion');
    }

    public function cotizacion()
    {
         return $this->hasMany('App\Cotizacion');
    }

    public function caracteristicas()
    {
        return $this->hasOne('App\Caracteristicas');
    }

    public function file()
    {
        return $this->belongsToMany('App\File','filebook');
    }

    public function historial()
    {
         return $this->hasMany('App\Historial');
    }
}
