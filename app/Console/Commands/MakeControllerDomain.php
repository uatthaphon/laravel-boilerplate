<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeControllerDomain extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'domain:controller 
                            {domain : The name of the domain class}
                            {controller : The name of the controller under domain class}
                            {--api : Exclude the create and edit methods from the controller.}
                            {--type : Manually specify the controller stub file to use.}
                            {--force : Create the class even if the controller already exists.}
                            {--i|invokable : Generate a single method, invokable controller class.},
                            {--m|model : Generate a resource controller for the given model.},
                            {--p|parent : Generate a nested resource controller class.},
                            {--r|resource : Generate a resource controller class.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new controller class under App/Domain namespace';

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
     * @return int
     */
    public function handle()
    {
        $domain = $this->argument('domain');
        $controller = $this->argument('controller');

        $name = "App\\Domains\\{$domain}\\Http\\Controllers\\{$controller}";

        try {
            $arguments = ['name' => $name];
            $arguments['--api'] = $this->option('api');
            $arguments['--type'] = $this->option('type');
            $arguments['--force'] = $this->option('force');
            $arguments['--invokable'] = $this->option('invokable');
            $arguments['--model'] = $this->option('model');
            $arguments['--parent'] = $this->option('parent');
            $arguments['--resource'] = $this->option('resource');

            $this->call('make:controller', $arguments);

            return Command::SUCCESS;
        } catch (\Exception $e) {
            Log::Error($e->getMessage());

            return Command::FAILURE;
        }
    }
}
