<?php

namespace App\Models\Local;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Http\Traits\UsesUuid;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, UsesUuid;

    protected $connected = 'local';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(\App\Models\Local\Role::class);
    }

    public function isSuperAdmin()
    {
        $PERMISSION_NAME_SUPER_ADMIN = 'all';
        return $this->hasPermissionByName( $PERMISSION_NAME_SUPER_ADMIN );
    }

    public function hasPermissionByName($name)
    {
        $permissions = \App\Models\Local\Permission::with('roles')->where('name', $name)->get();
        foreach ($permissions as $permission) {
            return $this->hasPermission($permission);
        }
    }

    public function hasPermission($permission)
    {
        return $this->hasAnyRoles($permission->roles);
    }

    public function hasAnyRoles($roles)
    {
        if(is_array($roles) || is_object($roles)){
            return !! $roles->intersect($this->roles)->count();
        }

        return $this->roles->contains('name', $roles);
    }
}
