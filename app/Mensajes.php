<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mensajes extends Model
{
    use SoftDeletes;

    protected $table = 'mensajes';

    const CREATED_AT = 'created_at';
	
	const UPDATED_AT = 'updated_at';

	const DELETED_AT = 'deleted_at';

	protected $primaryKey = 'id';

    protected $softDelete = true;

    protected $dates = ['deleted_at'];

    protected $fillable = ['mensaje'];

    public function libro()
    {
        return $this->belongsTo('App\Libro');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function archivo()
    {
        return $this->belongsTo('App\Archivo');
    }
}
