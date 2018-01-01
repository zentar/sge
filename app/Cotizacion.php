<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;


class Cotizacion extends Model
{     
    use SoftDeletes;

    use LogsActivity;

    protected $table = 'cotizaciones';

    const CREATED_AT = 'created_at';
	
	const UPDATED_AT = 'updated_at';

	const DELETED_AT = 'deleted_at';

	protected $primaryKey = 'id';

    protected $softDelete = true;

    protected $dates = ['deleted_at'];

    protected $fillable = ['imprenta','tiraje','valor'];


    public function book()
    {
        return $this->belongsTo('App\Book');
    }

    public function file()
    {
        return $this->belongsTo('App\File');
    }
}
