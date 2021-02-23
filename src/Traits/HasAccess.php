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
            if(request()->has('role'))
            {
                if(is_null($model->role))
                {
                    RoleEvent::dispatch('created', $model);
                } else if($model->role->id != request()->role) {
                    RoleEvent::dispatch('updated', $model);
                }
                $model->role()->associate(request()->role);
            }
        });
    }

    /**
     * Get the model record associated with the role.
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Check if the model has any roles
     * @param  mixed   $roles  Can be a string or an array
     * @param  string  $column Column where to search
     * @return boolean
     */
    public function hasRoles($roles, $column = 'guard')
    {
        return $this->role()->whereIn($column, (array)$roles)->exists();
    }

    /**
     * Check if the model has any permissions
     * @param  mixed   $permissions Can be a string or an array
     * @return boolean
     */
    public function hasPermissions($permissions)
    {
        return $this->role()->exists() && $this->role->hasPermissions((array)$permissions);
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
        return $this->role()->exists() && $this->role->hasPermissionsModel($model,$actions, $strict);
    }

}
