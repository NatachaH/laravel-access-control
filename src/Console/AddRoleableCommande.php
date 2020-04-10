<?php

namespace Nh\AccessControl\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class AddRoleableCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'role:new {model? : the name of the model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a model roleable';

    /**
     * Name of the model
     * @var string
     */
    protected $name;

    /**
     * Name of the model in plural
     * @var string
     */
    protected $pname;

    /**
     * Name of the model uppercase
     * @var string
     */
    protected $ucname;

    /**
     * Name of the model plural and uppercase
     * @var string
     */
    protected $ucpname;

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
        $name = $this->argument('model');
        if(empty($name))
        {
            $name = $this->ask('What is the name of the model (singular/lowercase) ?');
        }

        $this->name     = $name;
        $this->pname    = Str::plural($name);
        $this->ucname   = ucfirst($name);
        $this->ucpname  = ucfirst($this->pname);

        // Copy the files
        $stub = __DIR__.'/../../stubs/';

        // Database
        $sp_database   = $stub.'database/migrations/0000_00_00_000000_add_column_model_role_table.php';
        $new_database  = database_path('migrations/'.date('Y_m_d').'_000000_add_column_'.$this->pname.'_role_table.php');
        $this->copy_file($sp_database,$new_database);

        // end
        $this->line('The model '.$name.' is roleable !');
    }

    /**
     * Copy a stub file to a destination and replace the {{ NAME }}, {{ PNAME }}, {{ UCNAME }} and {{ UCPNAME }}
     * @param  string $original    File to copy
     * @param  string $destination Destination of the new file
     * @return void
     */
    private function copy_file($original, $destination)
    {
        if (!copy($original, $destination)) {
            echo "failed to copy";
        } else {
            file_put_contents($destination, str_replace('{{ NAME }}', $this->name, file_get_contents($destination)));
            file_put_contents($destination, str_replace('{{ UCNAME }}', $this->ucname, file_get_contents($destination)));
            file_put_contents($destination, str_replace('{{ UCPNAME }}', $this->ucpname, file_get_contents($destination)));
            file_put_contents($destination, str_replace('{{ PNAME }}', $this->pname, file_get_contents($destination)));
        }
    }
}
