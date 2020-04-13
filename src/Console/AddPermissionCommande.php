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
    protected $signature = 'permission:new {model? : the name of the model} {softDeletes? : is the model using SoftDeletes} {role? : set the permission for a role}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new permission for a model';

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
        $model = $this->argument('model');
        if(empty($model))
        {
            $model = $this->ask('What is the name of the model (singular/lowercase) ?');
        }

        // Defines actions and variables
        $softDeletes = $this->argument('softDeletes');
        if(empty($softDeletes))
        {
            $softDeletes = $this->confirm('Is the model using SoftDeletes ?', 0);
        }

        // Defines role that as access to the permission
        $role = $this->argument('role');
        if(empty($role))
        {
            $roleNeeded = $this->confirm('Do you want to set this permission to a role ?', 0);
            if($roleNeeded) {
               $role = $this->ask('What is the name of the role ?');
            }
        }

        // Define the actions
        $actions = ['view','create','update','delete'];
        if($softDeletes) {
          $actions[] = 'restore';
          $actions[] = 'force-delete';
        }

        // Seed the database
        $ids = [];

        foreach ($actions as $action)
        {
            $permission = Permission::create([
                'name' => $model.'-'.$action,
                'model' => $model,
                'action' => $action
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
        $this->line('The permissions for the model '.$model.' has been created !');
    }
}
