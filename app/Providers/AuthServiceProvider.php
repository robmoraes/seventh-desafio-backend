<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
use App\Models\Local\User;
use App\Policies\RolePolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Passport::routes();
        $this->defineGates();
        //
    }

    private function defineGates()
    {
        Gate::before(function(User $user, $ability){
            if($user->isSuperAdmin()){
                return true;
            }
        });

        if (\Illuminate\Support\Facades\Schema::hasTable('permissions')) {
            $permissions = \App\Models\Local\Permission::with('roles')->get();
            foreach ($permissions as $permission) {
                Gate::define( $permission->name, function(User $user) use($permission){
                    return $user->hasPermission($permission);
                } );
            }
        }
    }
}
