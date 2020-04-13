<?php
namespace Nh\AccessControl\Composers;

use Illuminate\View\View;

use Nh\AccessControl\Permission;

class PermissionsComposer
{
    /**
     * List of permissions
     * @var \Nh\AccessControl\Permission
     */
    protected $permissions;

    /**
     * Create a new profile composer.
     *
     * @return void
     */
    public function __construct()
    {
        // Get permission with model
        $permissions = Permission::whereNotNull('model')->select('id','model','action')->get()->groupBy('model');

        // Get permission without model
        $permissionWithoutModel = Permission::whereNull('model')->select('id','name','action')->get()->keyBy('name');

        // Foreach permission without model, set default action as view and push in $permissions
        foreach ($permissionWithoutModel as $key => $value) {
          $value->action = 'view';
          $permissions[$key] = collect()->push($value);
        }

        // Set the permissions
        $this->permissions = $permissions;
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
