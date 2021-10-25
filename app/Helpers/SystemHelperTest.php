<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SystemHelperTest extends TestCase
{
    protected $disk = 'test';
    protected $directory = 'test_files';
    protected $testingRootPath;

    protected function setUp(): void
    {
        parent::setUp();

        $this->testingRootPath = config('filesystems.disks.test.root');

        Storage::disk($this->disk)->put($this->directory . DIRECTORY_SEPARATOR . 'file1.php', '<?php return [];');
        Storage::disk($this->disk)->put($this->directory . DIRECTORY_SEPARATOR . 'file2.php', '<?php return [];');
        Storage::disk($this->disk)->put($this->directory . DIRECTORY_SEPARATOR . 'file3.php', '<?php return [];');
    }

    protected function tearDown(): void
    {
        Storage::disk($this->disk)->deleteDirectory($this->directory);

        parent::tearDown();
    }

    public function test_include_files_in_folder()
    {
        $testingDirectory = $this->testingRootPath . DIRECTORY_SEPARATOR . $this->directory;

        includeRouteFiles($testingDirectory);

        $allIncludedFiles = get_included_files();

        foreach (Storage::disk($this->disk)->files($this->directory) as $file) {
            $this->assertTrue(in_array($this->testingRootPath . DIRECTORY_SEPARATOR . $file, $allIncludedFiles));
        }
    }
}
