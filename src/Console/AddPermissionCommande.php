<?php

namespace Nh\AccessControl\Commands;

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
    protected $signature = 'permission:new {--model= : the name of the model}';

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
        // Defines names and variables
        $model = $this->option('model');

        if(!empty($model))
        {
            // Defines if need the soft delete actions
            $softDeletes = $this->confirm('Is the model using SoftDeletes ?', 0);

            // Define the actions
            $actions = ['view','create','update','delete'];
            if($softDeletes) {
              $actions[] = 'restore';
              $actions[] = 'force-delete';
            }
        } else {
            $name = $this->as('What is the name of your permission ?');
        }

        // Defines role that as access to the permission
        $roleNeeded = $this->confirm('Do you want to set this permission to a role ?', 0);
        if($roleNeeded) {
           $role = $this->ask('What is the name of the role ?');
        }

        // Seed the database
        $ids = [];

        if(!empty($model))
        {
          foreach ($actions as $action)
          {
              $permission = Permission::create([
                  'name' => $model.'-'.$action,
                  'model' => $model,
                  'action' => $action
              ]);

              $ids[] = $permission->id;
          }
        } else {
          $permission = Permission::create([
              'name' => $name,
              'model' => NULL,
              'action' => NULL
          ]);

          $ids[] = $permission->id;
        }

        // Attach the permissions to the admin Role
        if(!empty($role))
        {
            $admin_role = Role::where('name',$role)->first();
            if(!empty($admin_role))
            {
                $admin_role->permissions()->attach($ids);
            }
        }

        // End
        $this->line('The permission has been created !');
    }
}
