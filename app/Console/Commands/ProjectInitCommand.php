<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Artisan;
class ProjectInitCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initailize the project';

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
        
        
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        Artisan::call('migrate:fresh --force');
        Artisan::call('db:seed');
        Artisan::call('storage:link');
        Artisan::call('key:generate');
        // Artisan::call('route:cache'); 
        // it get Unable to prepare route [api/user] for serialization. Uses Closure.
        Artisan::call('view:cache');
        Artisan::call('config:cache');
        // Artisan::call('event:cache');
        // Artisan::call('optimize', ['--quiet' => true]);
        exec('composer install --optimize-autoloader');
        exec('npm install');
        
    }
}
