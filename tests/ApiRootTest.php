<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ApiRootTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRootResponse()
    {
        $this->get('/');

        $this->assertEquals(
            config('app.name') . ' → ' . $this->app->version(),
            $this->response->getContent()
        );
    }
}
