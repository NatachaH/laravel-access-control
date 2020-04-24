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
        return in_array($option, $this->optionsChecked) ? config('access-control.icons.check.class') : config('access-control.icons.cross.class');
    }

    /**
     * Get the color of the option
     * @param  string  $option
     * @return string
     */
    public function optionColor($option)
    {
        return in_array($option, $this->optionsChecked) ? config('access-control.icons.check.color') : config('access-control.icons.cross.color');
    }

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($checked)
    {
        $this->optionsChecked = $checked;
        $this->translation    = config('access-control.translations.permission');
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
