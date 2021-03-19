<?php

namespace Nh\AccessControl\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Role;

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
     * Get the roles record associated with the permission.
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

}
