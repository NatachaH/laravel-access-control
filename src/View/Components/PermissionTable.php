<?php

namespace Nh\AccessControl\View\Components;

use Illuminate\View\Component;

class PermissionTable extends Component
{

    /**
     * The default values that are checked
     *
     * @var array
     */
    public $optionsChecked;

    /**
     * The path for the $key translation
     * @var string
     */
    public $translation;

    /**
     * Get the icon of the option
     * @param  string  $option
     * @return string
     */
    public function optionIcon($option)
    {
        return in_array($option, $this->optionsChecked) ? 'checkmark' : 'cross';
    }

    /**
     * Get the color of the option
     * @param  string  $option
     * @return string
     */
    public function optionColor($option)
    {
        return in_array($option, $this->optionsChecked) ? 'success' : 'danger';
    }

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($checked, $translation = 'permission')
    {
        $this->optionsChecked = $checked;
        $this->translation    = $translation;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('ac::permissions.table');
    }
}
