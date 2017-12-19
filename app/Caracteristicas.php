<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Caracteristicas extends Model
{
     use SoftDeletes;

    protected $table = 'caracteristicas';

    const CREATED_AT = 'created_at';
	
	const UPDATED_AT = 'updated_at';

	const DELETED_AT = 'deleted_at';

	protected $primaryKey = 'id';

    protected $softDelete = true;

    protected $dates = ['deleted_at'];

    protected $fillable = ['tamano','tipo_papel','n_paginas','color','cubierta','solapas','observaciones'];

    protected $attributes = [
        'tamano' => '-',
        'tipo_papel' => '-',
        'n_paginas' => '-',
        'color' => '-',
        'cubierta' => '-',
        'solapas' => '-',
        'observaciones' => '-'
    ];

    public function book()
    {
        return $this->belongsTo('App\Book');
    }
}
