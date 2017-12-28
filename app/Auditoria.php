<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Auditoria extends Model
{
    use SoftDeletes;

    protected $table = 'auditoria';

    const CREATED_AT = 'created_at';
	
	const UPDATED_AT = 'updated_at';

	const DELETED_AT = 'deleted_at';

	protected $primaryKey = 'id';

    protected $softDelete = true;

    protected $dates = ['deleted_at'];

    protected $fillable = ['titulo','descripcion','tipo','ip','pc','user_id','rol_id','observaciones'];
}
