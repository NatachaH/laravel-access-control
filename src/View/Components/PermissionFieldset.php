<?php

namespace Nh\AccessControl\View\Components;

use Illuminate\View\Component;

class PermissionFieldset extends Component
{

    /**
     * The legend of the fieldset
     * @var string
     */
    public $legend;

    /**
     * The default checkboxes that are checked
     * @var string
     */
    public $values;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($legend, $values = [])
    {
        $this->legend = $legend;
        $this->values = $values;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('ac::permissions.fieldset');
    }
}
