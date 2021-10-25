<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Input\InputOption;

class DomainMakeModel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'domain:model 
                            {domain : The name of the domain class}
                            {model : The name of the model under domain class}
                            {--p|pivot : Indicates if the generated model should be a custom intermediate table model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Eloquent model class under App/Domain namespace';

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
        $model = $this->argument('model');

        $name = "App\\Domains\\{$domain}\\Models\\{$model}";

        try {
            $arguments = ['name' => $name];

            $arguments['--pivot'] = $this->option('pivot');

            $this->call('make:model', $arguments);

            return Command::SUCCESS;
        } catch (\Exception $e) {
            Log::Error($e->getMessage());

            return Command::FAILURE;
        }
    }

    protected function getOptions()
    {
        return [
            ['pivot', 'p', InputOption::VALUE_NONE, 'Indicates if the generated model should be a custom intermediate table model'],
        ];
    }
}
