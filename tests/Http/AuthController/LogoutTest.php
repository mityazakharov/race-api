<?php

namespace Http\AuthController;

class LogoutTest extends AuthControllerTest
{
    public function testLogout(): void
    {
        $this->json('POST', $this->buildUrl('logout'), [], $this->getAuthHeaders())
            ->seeJsonStructure(
                [
                    'result',
                    'data' => [
                        'message',
                    ],
                ]
            )
            ->assertResponseOk();
    }
}
