<?php
namespace Nh\AccessControl;

use Illuminate\Support\ServiceProvider;


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
            __DIR__.'/Models/Role.php' => app_path('Models/Role.php')
        ], 'access-control');


    }
}
