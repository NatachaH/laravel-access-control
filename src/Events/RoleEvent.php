<?php

namespace Nh\AccessControl\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Role;

class RoleEvent
{
    use Dispatchable, SerializesModels;

    /**
     * Name of the event
     * @var string
     */
    public $name;

    /**
     * The model parent of the role
     * @var \Illuminate\Database\Eloquent\Model
     */
    public $model;

    /**
     * The role model
     * @var \App\Models\Role
     */
    public $relation;

    /**
     * The number of role model affected
     * @var int
     */
    public $number;

    /**
     * Create a new event instance.
     * @param string  $name
     * @param \Illuminate\Database\Eloquent\Model  $model
     * @param \App\Models\Role  $relation
     * @param int  $number
     */
    public function __construct($name,$model,$relation = null,$number = null)
    {
        $this->name     = $name;
        $this->model    = $model;
        $this->relation = is_null($relation) ? new Role : $relation;
        $this->number   = $number;
    }
}
