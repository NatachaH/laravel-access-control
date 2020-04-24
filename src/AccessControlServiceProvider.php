<?php
namespace Nh\AccessControl;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;


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
        Blade::component('ac-permission-fieldset', \Nh\AccessControl\View\Components\PermissionFieldset::class);
        Blade::component('ac-permission-table', \Nh\AccessControl\View\Components\PermissionTable::class);
        Blade::component('ac-role-fieldset', \Nh\AccessControl\View\Components\RoleFieldset::class);

        // COMPOSERS
        View::composer(
          ['ac::permissions.fieldset','ac::permissions.table'], 'Nh\AccessControl\Composers\PermissionsComposer'
        );

        View::composer(
          ['ac::roles.fieldset'], 'Nh\AccessControl\Composers\RolesComposer'
        );

        // VENDORS
        $this->publishes([
            __DIR__.'/../config/access-control.php' => config_path('access-control.php'),
            __DIR__.'/../database/migrations/2020_04_10_000001_create_roles_table.php' => base_path('database/migrations/2020_04_10_000001_create_roles_table.php'),
            __DIR__.'/../database/migrations/2020_04_10_000002_create_permissions_table.php' => base_path('database/migrations/2020_04_10_000002_create_permissions_table.php'),
            __DIR__.'/../database/migrations/2020_04_10_000003_create_permission_role_table.php' => base_path('database/migrations/2020_04_10_000003_create_permission_role_table.php')
        ], 'access-control');


    }
}
