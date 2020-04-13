<?php

namespace Nh\AccessControl\View\Components;

use Illuminate\View\Component;

class RoleFieldset extends Component
{

    /**
     * The legend of the fieldset
     * @var string
     */
    public $legend;

    /**
     * The label of the select
     * @var string
     */
    public $label;

    /**
     * The default value of the select
     * @var string
     */
    public $value;

    /**
     * Is the select required
     * @var string
     */
    public $isRequired;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($legend, $label = '', $value = '', $required)
    {
        $this->legend       = $legend;
        $this->label        = empty($label) ? $legend : $label;
        $this->value        = $value;
        $this->isRequired   = $isRequired;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('ac::roles.fieldset');
    }
}
