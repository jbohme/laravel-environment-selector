<?php

namespace Jbohme\LaravelEnvironmentSelector\Tests\Feature;

use Tests\TestCase;

class SampleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_batata()
    {
//        $response = $this->get('/');
        $this->artisan('env')->expectsOutput();

//        $this->assertEquals(true, true, 'teste ok!');
    }
}
