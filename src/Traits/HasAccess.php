<?php
namespace Nh\AccessControl\Traits;

use App;
use Illuminate\Database\Eloquent\Builder;

use Nh\AccessControl\Events\RoleEvent;
use App\Models\Role;

trait HasAccess
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    protected static function bootHasAccess()
    {
        // Attache a role to a model when saving it
        static::saving(function ($model)
        {
            // Request for one role
            if(!config('access-control.manyRoles') && request()->has('role'))
            {
                if(is_null($model->role))
                {
                    $event = 'created';
                } else if($model->role->id != request()->role) {
                    $event = 'updated';
                }
                $model->role()->associate(request()->role);
                RoleEvent::dispatch($event, $model, $model->role());
            }
        });

        // Attache a role to a model when saved
        static::saved(function ($model)
        {
            // Request for many roles
            if(config('access-control.manyRoles') && request()->has('roles'))
            {
                $event = $model->hasAnyRole() ? 'updated' : 'created';
                $sync = $model->roles()->sync(request()->roles);
                if(!empty(array_filter($sync)))
                {
                    RoleEvent::dispatch($event, $model);
                }
            }
        });
    }

    /**
     * Get the model record associated with the role.
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function role()
    {
        return config('access-control.manyRoles') ? null : $this->belongsTo(Role::class) ;
    }

    /**
     * Get the roles of a model.
     * @return \App\Models\Role
     */
    public function roles()
    {
        return config('access-control.manyRoles') ? $this->morphToMany(Role::class, 'roleable')->withTimestamps() : null;
    }

    /**
     * Check if the model has at least one role
     * @return boolean
     */
    public function hasAnyRole()
    {
        return config('access-control.manyRoles') ? $this->roles()->exists() : $this->role()->exists();
    }

    /**
     * Check if the model has any roles
     * @param  mixed   $roles  Can be a string or an array
     * @param  string  $column Column where to search
     * @return boolean
     */
    public function hasRoles($roles, $column = 'guard')
    {
        // Request for many
        if(config('access-control.manyRoles'))
        {
            return $this->roles()->whereIn($column,(array)$roles)->exists();
        }

        // Default request
        return $this->role()->whereIn($column, (array)$roles)->exists();
    }

    /**
     * Check if the model has any permissions
     * @param  mixed   $permissions Can be a string or an array
     * @return boolean
     */
    public function hasPermissions($permissions)
    {
        // If no roles return false
        if(!$this->hasAnyRole()) return false;

        // Request for many
        if(config('access-control.manyRoles'))
        {
            // Check foreach roles if permission exists
            $access = [];
            foreach ($this->roles as $role) {
                $access[] = $role->hasPermissions((array)$permissions) ? $role->id : null;
            }
            return !empty(array_filter($access));
        }

        // Default request
        return $this->role->hasPermissions((array)$permissions);
    }

    /**
     * Check if model as access to a specific model/action(s)
     * @param  string  $model   Model name (lowercase and singulare)
     * @param  mixed   $actions Can be null, a string or an array
     * @param  boolean $strict  Is all actions should be available
     * @return boolean
     */
    public function hasAccess($model, $actions = null, $strict = false)
    {
        // If no roles return false
        if(!$this->hasAnyRole()) return false;

        // Request for many
        if(config('access-control.manyRoles'))
        {
            // Check foreach roles if permission exists
            $access = [];
            foreach ($this->roles as $role) {
                $access[] = $role->hasPermissionsModel($model,$actions, $strict) ? $role->id : null;
            }
            return !empty(array_filter($access));
        }

        // Default request
        return $this->role->hasPermissionsModel($model,$actions, $strict);
    }

    /**
     * Get the permission restrictions for a model
     * @return array
     */
     public function getPermissionRestrictionsAttribute()
     {
         // Request for many
         if(config('access-control.manyRoles'))
         {
             // Regroup all permissions and then gett the diff
             $permissions = [];
             foreach ($this->roles as $role) {
                $permissions = array_merge($permissions,$role->permissions->modelKeys());
             }
             return  \Nh\AccessControl\Models\Permission::whereNotIn('id',$permissions)->get()->modelKeys();
         }

         // Default request
         return $this->role->restrictions()->modelKeys();
     }

     /**
      * Check if the model has superpowers
      * @return boolean
      */
     public function getHasSuperpowersAttribute()
     {
         return $this->hasRoles(config('access-control.superpowers'));
     }

     /**
      * Scope a query with role(s).
      *
      * @param  \Illuminate\Database\Eloquent\Builder  $query
      * @param  mixed $value
      * @param  string $column
      * @return \Illuminate\Database\Eloquent\Builder
      */
     public function scopeWithRole(Builder $query, $value = null, string $column = 'guard')
     {
         return $query->whereHas('roles', function($query) use ($value,$column){
           $query->whereIn($column,(array)$value);
         });
     }


}
