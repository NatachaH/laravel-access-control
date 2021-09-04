<?php

namespace Nh\AccessControl\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Role;
use Nh\AccessControl\Models\Permission;

class PermissionEvent
{
    use Dispatchable, SerializesModels;

    /**
     * Name of the event
     * @var string
     */
    public $name;

    /**
     * The role model
     * @var App\Models\Role
     */
    public $model;

    /**
     * The permission model
     * @var \Nh\AccessControl\Models\Permission
     */
    public $relation;

    /**
     * The number of permission model affected
     * @var int
     */
    public $number;

    /**
     * Create a new event instance.
     * @param string  $name
     * @param \App\Models\Role  $model
     * @param \Nh\AccessControl\Models\Permission
     * @param int  $number
     */
    public function __construct($name,$model,$relation = null,$number = null)
    {
        $this->name     = $name;
        $this->model    = $model;
        $this->relation = is_null($relation) ? new Permission : $relation;
        $this->number   = $number;
    }
}
