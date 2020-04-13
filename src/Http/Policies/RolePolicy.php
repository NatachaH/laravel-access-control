<?php

namespace Nh\AccessControl\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

use Nh\AccessControl\Role;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can access to a role.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function before(User $user)
    {
        //return true;
    }

    /**
     * Determine whether the user can view any roles.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasAccess('role','view');
    }


    /**
     * Determine whether the user can view the role.
     *
     * @param  \App\User  $user
     * @param  \Nh\AccessControl\Role  $role
     * @return mixed
     */
    public function view(User $user, Role $role)
    {
        return $user->hasAccess('role','view');
    }

    /**
     * Determine whether the user can create roles.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasAccess('role','create');
    }

    /**
     * Determine whether the user can update the role.
     *
     * @param  \App\User  $user
     * @param  \Nh\AccessControl\Role  $role
     * @return mixed
     */
    public function update(User $user, Role $role)
    {
        return $user->hasAccess('role','update');
    }

    /**
     * Determine whether the user can delete the role.
     *
     * @param  \App\User  $user
     * @param  \Nh\AccessControl\Role  $role
     * @return mixed
     */
    public function delete(User $user, Role $role)
    {
        return $user->hasAccess('role','delete');
    }

}
