<?php

namespace Nh\AccessControl\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

use Nh\AccessControl\Permission;

class PermissionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can access to a permission.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function before(User $user)
    {
        //return true;
    }

    /**
     * Determine whether the user can view any permissions.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasAccess('permission','view');
    }


    /**
     * Determine whether the user can view the permission.
     *
     * @param  \App\User  $user
     * @param  \Nh\AccessControl\Permission  $permission
     * @return mixed
     */
    public function view(User $user, Permission $permission)
    {
        return false;//$user->hasAccess('permission','view');
    }

    /**
     * Determine whether the user can create permissions.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasAccess('permission','create');
    }

    /**
     * Determine whether the user can update the permission.
     *
     * @param  \App\User  $user
     * @param  \Nh\AccessControl\Permission  $permission
     * @return mixed
     */
    public function update(User $user, Permission $permission)
    {
        return $user->hasAccess('permission','update');
    }

    /**
     * Determine whether the user can delete the permission.
     *
     * @param  \App\User  $user
     * @param  \Nh\AccessControl\Permission  $permission
     * @return mixed
     */
    public function delete(User $user, Permission $permission)
    {
        return $user->hasAccess('permission','delete');
    }

}
