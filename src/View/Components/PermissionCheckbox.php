<?php

namespace Nh\AccessControl\View\Components;

use Illuminate\View\Component;

class PermissionCheckbox extends Component
{

    /**
     * The array of the default values.
     *
     * @var array
     */
    public $values;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($values = [])
    {
        $this->values = $values;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('ac::permissions.form');
    }
}
