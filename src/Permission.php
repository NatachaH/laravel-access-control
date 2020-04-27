<?php

namespace Nh\AccessControl;

use Illuminate\Database\Eloquent\Model;

use Nh\AccessControl\Role;
use Nh\Searchable\Traits\Searchable;

class Permission extends Model
{

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

}
