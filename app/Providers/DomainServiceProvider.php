<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class DomainServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->resolveFactoryDomainName();
    }

    private function resolveFactoryDomainName()
    {
        Factory::guessFactoryNamesUsing(function (string $modelName) {
            $namespace = 'Database\\Factories\\';
            $appNamespace = 'App\\';
            $domainNamespace = $appNamespace . 'Domains\\';

            $guessNamespace = '';

            if (Str::startsWith($modelName, $domainNamespace)) {
                $guessNamespace = 'Domains\\' . Str::between($modelName, $domainNamespace, 'Models\\');
            }

            $modelName = Str::afterLast($modelName, '\\');

            return $namespace . $guessNamespace . $modelName . 'Factory';
        });
    }
}
