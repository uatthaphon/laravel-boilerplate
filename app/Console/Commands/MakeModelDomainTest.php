<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Tests\TestCase;

class MakeModelDomainTest extends TestCase
{
    public function test_make_model_domain_successfully()
    {
        $domain = 'TestDomain';
        $model = 'TestModel';
        $testDirectory = app_path("Domains/{$domain}");
        $expected = "{$testDirectory}/Models/{$model}.php";

        $this->clearDirectory($testDirectory);

        $command = $this->artisan("domain:model {$domain} {$model}");

        $command->execute();

        $command->expectsOutput(Command::SUCCESS);

        $this->assertFileExists($expected);

        $expectedContents = <<<CLASS
<?php

namespace App\Domains\TestDomain\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestModel extends Model
{
    use HasFactory;
}

CLASS;

        $this->assertEquals($expectedContents, file_get_contents($expected));

        $this->clearDirectory($testDirectory);
    }

    public function test_make_model_domain_with_option_pivot_successfully()
    {
        $domain = 'TestDomain';
        $model = 'TestModel';
        $testDirectory = app_path("Domains/{$domain}");
        $expected = "{$testDirectory}/Models/{$model}.php";

        $this->clearDirectory($testDirectory);

        $command = $this->artisan("domain:model {$domain} {$model} --pivot");

        $command->execute();

        $command->expectsOutput(Command::SUCCESS);

        $this->assertFileExists($expected);

        $expectedContents = <<<CLASS
<?php

namespace App\Domains\TestDomain\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class TestModel extends Pivot
{
    //
}

CLASS;

        $this->assertEquals($expectedContents, file_get_contents($expected));

        $this->clearDirectory($testDirectory);
    }
}
