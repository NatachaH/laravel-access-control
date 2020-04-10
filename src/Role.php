<?php

namespace Nh\AccessControl\Models;

use Illuminate\Database\Eloquent\Model;

use Nh\AccessControl\Models\Permission;

class Role extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Default number of items per page.
     * @var int
     */
    protected $perPage = 10;

    /**
     * Get the permissions record associated with the role.
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Check if a role has some permission
     * @param  mixed   $permissions  Can be a string or an array
     * @param  string  $column       Column where to search
     * @return boolean
     */
    public function hasPermissions($permissions, $column = 'name')
    {
        return $this->permissions()->whereIn($column, (array)$permissions)->exists();
    }

    /**
     * Check if a role has some permission for a Model
     * @param  string  $model   Model name (lowercase and singulare)
     * @param  mixed   $actions Can be null, a string or an array
     * @param  boolean $strict  Is all actions should be available
     * @return boolean
     */
    public function hasPermissionsModel($model, $actions = null, $strict = false)
    {
        // If strict search for all permission actions exists
        if($strict) return $this->checkPermissionsModel($model,$actions);

        // If no action check if there is any model permission
        if(is_null($actions)) return $this->permissions()->where('model', $model)->exists();

        // Check if there is any model/action permission
        return $this->permissions()->where('model', $model)->whereIn('action', (array)$actions)->exists();
    }

    /**
     * Check the actions permissions for a model
     * @param  string $model   Model name (lowercase and singulare)
     * @param  mixed  $actions Can be null, a string or an array
     * @return boolean
     */
    private function checkPermissionsModel($model, $actions = null)
    {

        // If there is no action, get all the existing action premissions for the model
        if(is_null($actions))
        {
            $actions = Permission::where('model', $model)->pluck('action')->toArray();
        } else {
            $actions = (array)$actions;
        }

        // Check foreach action if permission exists
        foreach ($actions as $action) {
            $exist = $this->permissions()->where('model', $model)->where('action', $action)->exists();
            if(!$exist) return false;
        }
        return true;
    }

}
