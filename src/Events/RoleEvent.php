<?php

namespace Nh\AccessControl\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RoleEvent
{
    use Dispatchable, SerializesModels;

    public $name;
    public $model;
    public $relation;

    /**
     * Create a new event instance.
     * @param string  $name
     * @param \Illuminate\Database\Eloquent\Model  $model
     */
    public function __construct($name,$model,$relation = null)
    {
          $this->name     = $name;
          $this->model    = $model;
          $this->relation = $relation;

    }
}
