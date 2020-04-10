<?php

namespace Nh\AccessControl\Models;

use Illuminate\Database\Eloquent\Model;

use Nh\AccessControl\Models\Role;

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
     * Get the roles record associated with the permission.
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

}
