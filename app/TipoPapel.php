<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoPapel extends Model
{
    protected $table = 'tipopapel';

    const CREATED_AT = 'created_at';
	
	const UPDATED_AT = 'updated_at';

	const DELETED_AT = 'deleted_at';

	protected $primaryKey = 'id';

    protected $softDelete = true;

    protected $fillable = ['descripcion'];


    public function caracteristicas()
    {
         return $this->belongsTo('App\Caracteristicas','tipopapel_id','id');
    }
    
}
