<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Autor extends Model
{
	use SoftDeletes;
	
    protected $table = 'autors';

    const CREATED_AT = 'created_at';
	
	const UPDATED_AT = 'updated_at';

	const DELETED_AT = 'deleted_at';

    protected $softDelete = true;

	protected $primaryKey = 'id';

	protected $dates = ['deleted_at'];

    protected $fillable = ['cedula', 'nombre','apellido','email','telefono','filiacion','documentos'];

     public function Book()
    {
        return $this->belongsToMany('App\Book','autorbook');
    }

    public function Capitulos()
    {
        return $this->belongsToMany('App\Capitulos','autorcapitulos');
    }

    public function File()
    {
        return $this->belongsToMany('App\File','fileautor');
    }
    

    
}
