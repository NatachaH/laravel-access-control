<?php
namespace Nh\AccessControl;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;


class AccessControlServiceProvider extends ServiceProvider
{

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        // COMMANDES
        if ($this->app->runningInConsole())
        {
            $this->commands([
                \Nh\AccessControl\Console\Commands\AddPermissionCommand::class,
                \Nh\AccessControl\Console\Commands\AddRoleableCommand::class,
            ]);
        }

        // VENDORS
        $this->publishes([
            __DIR__.'/../database/migrations/2020_04_10_000001_create_roles_table.php' => base_path('database/migrations/2020_04_10_000001_create_roles_table.php'),
            __DIR__.'/../database/migrations/2020_04_10_000002_create_permissions_table.php' => base_path('database/migrations/2020_04_10_000002_create_permissions_table.php'),
            __DIR__.'/../database/migrations/2020_04_10_000003_create_permission_role_table.php' => base_path('database/migrations/2020_04_10_000003_create_permission_role_table.php'),
            __DIR__.'/Models/Role.php' => app_path('Models/Role.php'),
            __DIR__.'/../config/access-control.php' => config_path('access-control.php')

        ], 'access-control');

        // GATE
        Gate::define('set-roles', function ($user, $roles)
        {
            // Get the guarded roles
            $guarded = config('access-control.guarded');

            // If theire is no guarded roles
            if(empty($guarded)) return true;

            // If user have superpower => true
            if($user->has_superpowers) return true;

            // Check for each roles
            foreach ((array)$roles as $key => $roleId) {
                $role = \App\Models\Role::findOrFail($roleId);
                $inArray = in_array($role->guard,$guarded);
                if($inArray && !$user->hasRoles($role->guard)) return false;
            }
            return true;
        });

        // Only set the permission that the user have access
        Gate::define('set-permissions', function ($user, $permissions) {
            $restrictions = $user->permission_restrictions;
            return empty(array_intersect($permissions,$restrictions ?? []));
        });

    }
}
