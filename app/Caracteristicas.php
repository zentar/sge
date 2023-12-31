<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Caracteristicas extends Model
{
    use SoftDeletes;

    use LogsActivity;

    protected $table = 'caracteristicas';

    const CREATED_AT = 'created_at';
	
	const UPDATED_AT = 'updated_at';

	const DELETED_AT = 'deleted_at';

	protected $primaryKey = 'id';

    protected $softDelete = true;

    protected $dates = ['deleted_at'];

    protected $fillable = ['n_paginas','color','cubierta','solapas','observaciones'];

    protected $attributes = [
        'tamano' => 1,
        'tipopapel_id' => 1,
        'n_paginas' => 1,
        'colorpapel_id' => 1,
        'cubierta' => '-',
        'solapas' => '-',
        'observaciones' => '-'
    ];

    //LOGEA ATRIBUTOS DE ACTIVITYLOG (CAMBIOS EN DATOS)
    protected static $logAttributes = ['n_paginas','color','cubierta','solapas','observaciones'];
    //IGNORA UPDATED_AT EN CAMBIOS 
    protected static $ignoreChangedAttributes = ['updated_at'];
     //SOLO REGISTRA LOS CAMBIOS E UPDTES
    protected static $logOnlyDirty = true;

    public function libro()
    {
        return $this->belongsTo('App\Libro');
    }

    public function tamanopapel()
    {
        return $this->hasOne('App\TamanoPapel','id','tamano');
    }  

    public function tipopapel()
    {
        return $this->hasOne('App\TipoPapel','id','tipopapel_id');
    }  

    public function colorpapel()
    {
        return $this->hasOne('App\ColorPapel','id','colorpapel_id');
    }  
}
