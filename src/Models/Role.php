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
        'name'
    ];

}
