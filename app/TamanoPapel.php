<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TamanoPapel extends Model
{

    protected $table = 'tamanopapel';

    const CREATED_AT = 'created_at';
	
	const UPDATED_AT = 'updated_at';

	const DELETED_AT = 'deleted_at';

	protected $primaryKey = 'id';

    protected $softDelete = true;

    protected $fillable = ['descripcion'];

    


    public function caracteristicas()
    {
         return $this->belongsTo('App\Caracteristicas','tamano','id');
    }
}
