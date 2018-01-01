<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class Role
 *
 * @package App
 * @property string $title
*/
class Role extends Model
{
    protected $fillable = ['title'];
    
    use LogsActivity;   
    
}
