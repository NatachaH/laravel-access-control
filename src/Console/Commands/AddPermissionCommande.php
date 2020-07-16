<?php

namespace Nh\AccessControl\Console\Commands;

use Illuminate\Console\Command;

use Nh\AccessControl\Permission;
use Nh\AccessControl\Role;

class AddPermissionCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:new {--model= : the name of the model (singular/lowercase)} {--softDelete : is the model using SoftDelete}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new permission';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        // Array of permission ids
        $permission_ids = [];

        // Check if there is a model
        $model = $this->option('model');

        if(empty($model))
        {
            // No model, define the name of the permission
            $name = $this->ask('What is the name of your permission ?');

            // Check permission not exist
            $exist = Permission::where('name', $name)->exists();

            // If already exist, add error msg and stop
            if($exist)
            {
                $this->error('Sorry, a permission with the name '.$name.' already exist !');
                return;
            }

            // Create the permission
            $permission = Permission::create([
              'name' => $name
            ]);

            // Set the permission id
            $permission_ids[] = $permission->id;

            // Success
            $this->info('The permission '.$name.' has been created !');

        } else {

            // Check permission for this model not exist
            $exist = Permission::where('model', $model)->exists();

            // If already exist, add error msg adn stop
            if($exist)
            {
                $this->error('Sorry, a permission for the model '.$model.' already exist !');
                return;
            }

            // Define the actions
            $actions = ['view','create','update','delete'];

            // Defines if need the soft delete actions
            $softDelete = $this->option('softDelete');
            if($softDelete)
            {
                $actions[] = 'restore';
                $actions[] = 'force-delete';
            }

            // Create the permissions for each action
            foreach ($actions as $action)
            {
                $permission = Permission::create([
                  'model' => $model,
                  'action' => $action,
                  'name' => $model.'-'.$action
                ]);

                // Set the permission id
                $permission_ids[] = $permission->id;
            }

            // Success
            $this->info('The permission for the model '.$model.' has been created !');

        }

        // Add the permission(s) to a role
        $withRole = $this->confirm('Do you want to set this permission to a role ? [yes|no]', true);

        if($withRole)
        {
            $roles = Role::select('name')->get()->pluck('name')->toArray();
            $role_name = $this->choice('What is the name of the role ?',$roles);
            $role = Role::firstWhere('name',$role_name);
            $role->permissions()->attach($permission_ids);
        }

        // End
        $this->info('Good job, you have create a permission !');
    }
}
