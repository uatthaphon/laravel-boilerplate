<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class DomainMakeControllerTest extends TestCase
{
    public function test_make_controller_successfully()
    {
        $domain = 'TestDomain';
        $controller = 'TestController';
        $testDirectory = app_path("Domains/{$domain}");
        $expected = "{$testDirectory}/Http/Controllers/{$controller}.php";

        $this->clearDirectory($testDirectory);

        $command = $this->artisan("domain:controller {$domain} {$controller}");
        $command->execute();
        $command->expectsOutput(Command::SUCCESS);

        $this->assertFileExists($expected);

        $this->clearDirectory($testDirectory);
    }

    public function test_make_controller_with_force_option_successfully()
    {
        $domain = 'TestDomain';
        $controller = 'TestController';
        $testDirectory = app_path("Domains/{$domain}");
        $expected = "{$testDirectory}/Http/Controllers/{$controller}.php";

        $this->clearDirectory($testDirectory);

        $command = $this->artisan("domain:controller {$domain} {$controller}");
        $command->execute();
        $command->expectsOutput(Command::SUCCESS);

        $this->assertFileExists($expected);

        $expected = Command::SUCCESS;
        $actual = Artisan::call("domain:controller {$domain} {$controller} --force");
        $this->assertEquals($actual, $expected);

        $this->clearDirectory($testDirectory);
    }
}
