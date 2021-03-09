<?php

namespace App\Models\Local;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UsesUuid;
// use OwenIt\Auditing\Contracts\Auditable;

class Role extends Model /*implements Auditable*/
{
    use UsesUuid;
    // use \OwenIt\Auditing\Auditable;

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

    public function permissions()
    {
    	return $this->belongsToMany('\App\Models\Local\Permission');
    }
}
