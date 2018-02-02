<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class File extends Model
{
    use SoftDeletes;

    use LogsActivity;
	
    protected $table = 'file';

    const CREATED_AT = 'created_at';
	
	const UPDATED_AT = 'updated_at';

	const DELETED_AT = 'deleted_at';

    protected $softDelete = true;

	protected $primaryKey = 'id';

	protected $dates = ['deleted_at'];

    protected $fillable = ['nombre', 'nombre_subida','ruta','tipo','peso','filiacion','extension'];

    protected $attributes = [
        'observaciones' => '-'
    ];

    //LOGEA ATRIBUTOS DE ACTIVITYLOG (CAMBIOS EN DATOS)
    protected static $logAttributes = ['nombre', 'nombre_subida','ruta','tipo','peso','filiacion','extension'];
    //IGNORA UPDATED_AT EN CAMBIOS 
    protected static $ignoreChangedAttributes = ['updated_at'];
    //SOLO REGISTRA LOS CAMBIOS E UPDTES
    protected static $logOnlyDirty = true;

    public function Book()
    {
        return $this->belongsToMany('App\Book','filebook');
    }

    public function autor()
    {
        return $this->belongsToMany('App\Autor','fileautor');
    }    

    public function tipodoc()
    {
       // dd($this->belongsTo('App\Tipodoc'));
         return $this->belongsTo('App\Tipodoc');
    }

    public function cotizacion()
    {
       // dd($this->belongsTo('App\Tipodoc'));
         return $this->belongsTo('App\Cotizacion');
    }

    public function mensajes()
    {
        return $this->belongsTo('App\Mensajes');
    }
}
