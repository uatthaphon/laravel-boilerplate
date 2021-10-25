<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Tests\TestCase;

class DomainMakeRequestTest extends TestCase
{
    public function test_make_request_domain_successfully()
    {
        $domain = 'TestDomain';
        $request = 'TestRequest';
        $testDirectory = app_path("Domains/{$domain}");
        $expected = "{$testDirectory}/Http/Requests/{$request}.php";

        $this->clearDirectory($testDirectory);

        $command = $this->artisan("domain:request {$domain} {$request}");
        $command->execute();
        $command->expectsOutput(Command::SUCCESS);

        $this->assertFileExists($expected);

        $expectedContents = <<<CLASS
<?php

namespace App\Domains\TestDomain\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}

CLASS;

        $this->assertEquals($expectedContents, file_get_contents($expected));

        $this->clearDirectory($testDirectory);
    }
}
