<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Autor extends Model
{
    use SoftDeletes;
    
    use LogsActivity;
	
    protected $table = 'autores';

    const CREATED_AT = 'created_at';
	
	const UPDATED_AT = 'updated_at';

	const DELETED_AT = 'deleted_at';

    protected $softDelete = true;

	protected $primaryKey = 'id';

	protected $dates = ['deleted_at'];

    protected $fillable = ['cedula', 'nombre','apellido','email','telefono','filiacion'];

    //LOGEA ATRIBUTOS DE ACTIVITYLOG (CAMBIOS EN DATOS)
    protected static $logAttributes = ['cedula', 'nombre','apellido','email','telefono','filiacion'];
    //IGNORA UPDATED_AT EN CAMBIOS 
    protected static $ignoreChangedAttributes = ['updated_at'];
    //SOLO REGISTRA LOS CAMBIOS E UPDTES
    protected static $logOnlyDirty = true;


     public function Libro()
    {
        return $this->belongsToMany('App\Libro','autorlibro');
    }

    public function Capitulos()
    {
        return $this->belongsToMany('App\Capitulos','autorcapitulos');
    }

    public function Archivo()
    {
        return $this->belongsToMany('App\Archivo','archivoautor');
    }
    

    
}
