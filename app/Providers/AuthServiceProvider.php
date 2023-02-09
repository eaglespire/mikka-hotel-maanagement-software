<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Services\CacheKeys;
use App\Services\Permissions;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return false
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            return $user->hasRole('Moderator') ? true : null;
        });



        try {
         $allPermissions = Cache::remember(CacheKeys::PERMISSIONS_CACHE, now()->addDays(30), function (){
                return Permission::get();
            });

            $allRoles = Cache::remember(CacheKeys::ROLE_CACHE, now()->addDays(30), function (){
                return Role::get();
            });

         Log::info($allRoles);

            $allPermissions->map(function ($permission) use ($allRoles){
                Gate::define($permission->name, function (User $user) use ($permission,$allRoles){
                    //loop through all the roles and check if the permission is present
                    //and also if the user has the role passed to it

                    foreach ($allRoles as $role){
                        if ($user->hasRole($role['name']) && $role->hasPermission($permission->name)){
                            return true;
                        }
                    }
                    return false;
                });
            });
        } catch (\Exception $exception){
            report($exception);
            return false;
        }
    }
}
