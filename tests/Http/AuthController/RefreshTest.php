<?php

namespace Http\AuthController;

class RefreshTest extends AuthControllerTest
{
    public function testRefresh(): void
    {
        $this->json('POST', $this->buildUrl('refresh'), [], $this->getAuthHeaders())
            ->seeJsonStructure(
                [
                    'result',
                    'data' => [
                        'token',
                        'token_type',
                        'expires_in',
                    ],
                ]
            )
            ->assertResponseOk();
    }
}
