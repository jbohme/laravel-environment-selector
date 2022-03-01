<?php

namespace Jbohme\LaravelEnvironmentSelector\Tests\Unit;

use Illuminate\Support\Facades\File;
use Tests\TestCase;

class PublishTest extends TestCase
{
    /**
     * Simple test publish
     * @return void
     */
    public function test_publish(): void
    {
        $this->artisan('config:cache')->execute();
        $appFileBkp = file(base_path('bootstrap/app.php'));
        $this->artisan('vendor:publish --tag=laravel-env-selector')->execute();

        $this->artisan('publish-env-selector')->execute();
        $this->artisan('config:cache')->execute();
        $this->createApplication();

        $this->assertFileExists(base_path('env-selector.json'),'test ok!');

        File::put(base_path('bootstrap/app.php'), $appFileBkp);
        File::delete([base_path('env-selector.json')]);
    }
}
