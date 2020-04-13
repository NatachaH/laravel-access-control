<?php

namespace Nh\AccessControl\View\Components;

use Illuminate\View\Component;

class PermissionTable extends Component
{

    /**
     * The array of the default values.
     *
     * @var array
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
    public function __construct($values, $translation = 'permission')
    {
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
        return view('ac::permissions.table');
    }
}
