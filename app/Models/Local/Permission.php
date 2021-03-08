<?php

namespace App\Models\Local;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UsesUuid;
// use OwenIt\Auditing\Contracts\Auditable;

class Permission extends Model /*implements Auditable*/
{
    use UsesUuid;
    // use \OwenIt\Auditing\Auditable;

    protected $connected = 'local';

    /**
     * Attributes to include in the Audit.
     *
     * @var array
     */
    // protected $auditInclude = [
    //     'name',
    //     'label',
    // ];

    /**
     * Attributes to include in the massive persistence.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'label',
    ];

    public function roles()
    {
    	return $this->belongsToMany('\App\Models\Local\Role');
    }
}
