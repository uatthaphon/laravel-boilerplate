<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\File;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function clearDirectory(string $directory): bool
    {
        if (File::exists($directory)) {
            return File::deleteDirectory($directory);
        }

        return false;
    }
}
