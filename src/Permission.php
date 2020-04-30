<?php

namespace Nh\AccessControl;

use Illuminate\Database\Eloquent\Model;

use Nh\AccessControl\Role;
use Nh\Searchable\Traits\Searchable;
use Nh\Trackable\Traits\Trackable;

class Permission extends Model
{

    use Searchable;
    use Trackable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'model', 'action'
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
      'name', 'model', 'action'
    ];

    /**
     * Get the roles record associated with the permission.
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Get list of permissions by model
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function scopeGetByModel()
    {
      // Get permission with model
      $permissions = $this->whereNotNull('model')->select('id','model','action')->get()->groupBy('model');

      // Get permission without model
      $permissionWithoutModel = $this->whereNull('model')->select('id','name','action')->get()->keyBy('name');

      // Foreach permission without model, set default action as view and push in $permissions
      foreach ($permissionWithoutModel as $key => $value) {
        $value->action = 'view';
        $permissions[$key] = collect()->push($value);
      }

      // Set the permissions
      return $permissions;
    }

}
