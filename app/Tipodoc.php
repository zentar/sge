<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tipodoc extends Model
{  
    use SoftDeletes;

    protected $table = 'tipodoc';

    const CREATED_AT = 'created_at';
	
	const UPDATED_AT = 'updated_at';

	const DELETED_AT = 'deleted_at';

	protected $primaryKey = 'id';

    protected $softDelete = true;

    protected $dates = ['deleted_at'];

    protected $fillable = ['nombre','descripcion'];


    public function file()
    {
        return $this->hasMany('App\File');
    }  
    
}
