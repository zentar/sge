<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Libro extends Model
{
  
    use SoftDeletes;

    use LogsActivity;

    protected $table = 'libros';

    const CREATED_AT = 'created_at';
	
    const UPDATED_AT = 'updated_at';

    const DELETED_AT = 'deleted_at';

    protected $primaryKey = 'id';

    protected $softDelete = true;

    protected $dates = ['deleted_at'];

    protected $fillable = ['titulo','facultad_id','isbn','iepi','estados_id','coleccion_id','asignado'];

    //ASIGNA VALOR POR DEFAULT DE LOS ATRIBUTOS  
    protected $attributes = [
        'isbn' => '-',
        'iepi' => '-',
        'asignado'=>0
    ];

    //LOGEA ATRIBUTOS DE ACTIVITYLOG (CAMBIOS EN DATOS)
    protected static $logAttributes = ['titulo','facultad_id','isbn','iepi','estados_id','coleccion_id','asignado','campo_general','campo_especifico','campo_detallado'];
    //IGNORA UPDATED_AT EN CAMBIOS 
    protected static $ignoreChangedAttributes = ['updated_at'];
    //SOLO REGISTRA LOS CAMBIOS E UPDTES
    protected static $logOnlyDirty = true;
    
    // RELACIONES DE LIBRO
    public function autor()
    {
        return $this->belongsToMany('App\Autor','autorlibro');
    }

    public function user()
    {
        return $this->belongsToMany('App\User','userlibro')->withPivot('tipo','estado');
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

    public function archivo()
    {
        return $this->belongsToMany('App\Archivo','archivolibro');
    }

    public function historial()
    {
         return $this->hasMany('App\Historial');
    }

    public function mensajes()
    {
         return $this->hasMany('App\Mensajes');
    }

    public function campogeneral()
    {
        return $this->belongsTo('App\CampoGeneral','campo_general');
    }

    public function campoespecifico()
    {
        return $this->belongsTo('App\CampoEspecifico','campo_especifico');
    }

    public function campodetallado()
    {
        return $this->belongsTo('App\CampoDetallado','campo_detallado');
    }



}
