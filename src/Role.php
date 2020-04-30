<?php

namespace Nh\AccessControl;

use Illuminate\Database\Eloquent\Model;

use Nh\AccessControl\Permission;
use Nh\Searchable\Traits\Searchable;
use Nh\Trackable\Traits\Trackable;

class Role extends Model
{
    use Searchable;
    use Trackable;

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
     * The searchable columns.
     *
     * @var array
     */
    protected $searchable = [
      'name'
    ];

    /**
     * Get the permissions record associated with the role.
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Get the restrictions (Permission that the role don't have access).
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function restrictions()
    {
        return Permission::whereNotIn('id',$this->permissions->modelKeys())->get();
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

        // If all permission exist, return true
        return true;
    }

}
