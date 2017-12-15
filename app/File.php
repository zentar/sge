<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;
	
    protected $table = 'file';

    const CREATED_AT = 'created_at';
	
	const UPDATED_AT = 'updated_at';

	const DELETED_AT = 'deleted_at';

    protected $softDelete = true;

	protected $primaryKey = 'id';

	protected $dates = ['deleted_at'];

    protected $fillable = ['nombre', 'nombre_subida','ruta','tipo','peso','filiacion','extension'];

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

}
