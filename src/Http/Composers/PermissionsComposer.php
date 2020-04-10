<?php
namespace Nh\AccessControl\Composers;

use Illuminate\View\View;

use Nh\AccessControl\Models\Permission;

class PermissionsComposer
{
    /**
     * List of permissions
     * @var \Nh\AccessControl\Models\Permission
     */
    protected $permissions;

    /**
     * Create a new profile composer.
     *
     * @return void
     */
    public function __construct()
    {
        $this->permissions = Permission::orderBy('model')->get();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with(['permissions' => $this->permissions]);
    }
}
