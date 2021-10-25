<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeRequestDomain extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'domain:request 
                            {domain : The name of the domain class}
                            {request : The name of the request under domain class}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new form request class under App/Domain namespace';

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
        $request = $this->argument('request');

        $name = "App\\Domains\\{$domain}\\Http\\Requests\\{$request}";

        try {
            $arguments = ['name' => $name];

            $this->call('make:request', $arguments);

            return Command::SUCCESS;
        } catch (\Exception $e) {
            Log::Error($e->getMessage());

            return Command::FAILURE;
        }
    }
}
