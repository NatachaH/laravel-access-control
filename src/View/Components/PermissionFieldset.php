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
     * The default values that are checked
     * @var string
     */
    public $values;

    /**
     * The path for the $key translation
     * @var string
     */
    public $translation;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($legend, $values = [], $translation = 'permission')
    {
        $this->legend = $legend;
        $this->values = $values;
        $this->translation = $translation;
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
