<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Coleccion extends Model
{   
    use SoftDeletes;

    use LogsActivity;

    protected $table = 'coleccion';

    const CREATED_AT = 'created_at';
	
	const UPDATED_AT = 'updated_at';

	const DELETED_AT = 'deleted_at';

	protected $primaryKey = 'id';

    protected $softDelete = true;

    protected $dates = ['deleted_at'];

    protected $fillable = ['titulo','descripcion'];

    public function Libro()
    {
        return $this->hasMany('App\Libro');
    }  
}
