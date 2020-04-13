<?php
namespace Nh\AccessControl;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
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
                \Nh\AccessControl\Commands\AddPermissionCommand::class,
                \Nh\AccessControl\Commands\AddRoleableCommand::class,
            ]);
        }

        // VIEWS
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'ac');

        // TRANSLATIONS
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'ac');

        // BLADES
        Blade::component('ac-permission-checkbox', \Nh\AccessControl\View\Components\PermissionCheckbox::class);
        Blade::component('ac-permission-table', \Nh\AccessControl\View\Components\PermissionTable::class);


        // COMPOSERS
        View::composer(
          ['ac::permissions.form','ac::permissions.table'], 'Nh\AccessControl\Composers\PermissionsComposer'
        );

        // VENDORS
        $this->publishes([
            __DIR__.'/../database/migrations/2020_04_10_000001_create_roles_table.php' => base_path('database/migrations/2020_04_10_000001_create_roles_table.php'),
            __DIR__.'/../database/migrations/2020_04_10_000002_create_permissions_table.php' => base_path('database/migrations/2020_04_10_000002_create_permissions_table.php'),
            __DIR__.'/../database/migrations/2020_04_10_000003_create_permission_role_table.php' => base_path('database/migrations/2020_04_10_000003_create_permission_role_table.php')
        ], 'access-control');

        // POLICIES
        Gate::policy('\Nh\AccessControl\Permission', \Nh\AccessControl\Policies\PermissionPolicy::class);
        Gate::policy('\Nh\AccessControl\Role', \Nh\AccessControl\Policies\RolePolicy::class);

    }
}
