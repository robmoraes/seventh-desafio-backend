<?php

namespace App\Models\Local;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UsesUuid;

class Activitylog extends Model
{
    use UsesUuid;

    /**
     * Attributes to include in the massive persistence.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'description',
        'ip',
        'useragent',
        'created_at',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\Local\User::class);
    }
}
