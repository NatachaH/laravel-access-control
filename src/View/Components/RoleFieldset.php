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
     * @var boolean
     */
    public $required;

    /**
     * Is the select required
     * Can be a boolean or an array
     * @var mixed
     */
    public $disabled;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($legend, $label = '', $value = '', $required = false, $disabled = false)
    {
        $this->legend       = $legend;
        $this->label        = empty($label) ? $legend : $label;
        $this->value        = $value;
        $this->required     = $required;
        $this->disabled     = $disabled;
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
