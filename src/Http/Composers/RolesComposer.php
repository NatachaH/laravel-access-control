<?php
namespace Nh\AccessControl\Composers;

use Illuminate\View\View;

use Nh\AccessControl\Models\Role;

class RolesComposer
{
    /**
     * List of roles
     * @var \Nh\AccessControl\Models\Role
     */
    protected $roles;

    /**
     * Create a new profile composer.
     *
     * @return void
     */
    public function __construct()
    {
        $this->roles = Role::orderBy('name')->get();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('roles', $this->roles);
    }
}
