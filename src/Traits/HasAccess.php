<?php
namespace Nh\AccessControl\Traits;

use App;
use Illuminate\Database\Eloquent\Builder;

use Nh\AccessControl\Models\Role;

trait HasAccess
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    protected static function bootHasAccess()
    {
        // Attache a role to the model
        static::saving(function ($model)
        {
            if(request()->has('role'))
            {
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
    public function hasRoles($roles, $column = 'name')
    {
        return $this->role()->whereIn($column, (array)$roles)->exists();
    }

    /**
     * Check if the model has any permissions
     * @param  mixed   $permissions Can be a string or an array
     * @param  string  $column      Column where to search
     * @return boolean
     */
    public function hasPermissions($permissions, $column = 'name')
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
