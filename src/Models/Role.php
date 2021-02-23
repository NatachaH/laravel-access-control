<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Nh\AccessControl\Traits\HasPermissions;

class Role extends Model
{

    use HasPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'guard','name'
    ];

    /**
     * Check if the role is protected
     * @return boolean
     */
    public function getIsProtectedAttribute()
    {
       return in_array($this->guard, config('access-control.protected'));
    }

}
