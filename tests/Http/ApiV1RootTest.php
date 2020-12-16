<?php

namespace Http;

use TestCase;

class ApiV1RootTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRootResponse()
    {
        $this->get('/v1/');

        $this->assertEquals(
            config('app.name') . ' → ' . $this->app->version(),
            $this->response->getContent()
        );
    }
}
