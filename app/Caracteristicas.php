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

    protected $fillable = ['tipo_papel','n_paginas','color','cubierta','solapas','observaciones'];

    protected $attributes = [
        'tamano' => 1,
        'tipo_papel' => '-',
        'n_paginas' => 0,
        'color' => 0,
        'cubierta' => '-',
        'solapas' => '-',
        'observaciones' => '-'
    ];

    public function book()
    {
        return $this->belongsTo('App\Book');
    }

    public function tamanopapel()
    {
        return $this->hasOne('App\TamanoPapel','id');
    }  
}
