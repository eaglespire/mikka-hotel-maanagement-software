<?php

namespace App\Traits;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasRoles
{
    public function roles() : BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }
    public function permissions() : BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    /*
     * This function is used to assign a single role or an array of roles to the user
     * by passing in the ids of the roles to assign to the user
     */
    public function assignRole(...$arr): array
    {
        $arr = collect($arr)->flatten();
        return $this->roles()->sync($arr,false);
    }
    /*
     * This function removes a specific role or an array of roles
     * from the current user
     */
    public function revokeRole(...$roles): bool
    {
        $userRoles = $this->getCurrentUserRoles($roles);
        return (bool) $this->roles()->detach($userRoles);
    }

    /*
     * This function gets all the roles of the current user
     * We pass the ids of the roles
     */
    protected function getCurrentUserRoles(array $roles)
    {
        return Role::whereIn('id',$roles)->get();
    }

    /*
     * This function checks to see if the current user has a given role
     * We pass any number of roles to this function
     */
    public function hasRole(...$roles) : bool
    {
        foreach($roles as $role){
            if ($this->roles->contains('name',$role)){
                return true;
            }
        }
        return false;
    }

    public function assignPermission(...$permissions): array
    {
        /*
         * Pass in either a single id or multiple ids of permissions
         */
        return $this->permissions()->sync($permissions,false);
    }
    /*
     * Revoke permission for a given model
     */
    public function revokePermission(...$permissions): bool
    {
        $modelPermissions = $this->getModelPermissions($permissions);
       return (bool) $this->permissions()->detach($modelPermissions);
    }
    /*
     * Check if model has a given permission or permissions
     */
    public function hasPermission(...$permissions) : bool
    {
        foreach ($permissions as $permission){
            if ($this->permissions->contains('name',$permission)){
                return true;
            }
        }
        return false;
    }
    public function countPermissions(): int
    {
        return $this->permissions->count();
    }
    public function countRoles(): int
    {
        return $this->roles->count();
    }
    protected function getModelPermissions(array $permissions)
    {
        return Permission::whereIn('id',$permissions)->get();
    }

}
