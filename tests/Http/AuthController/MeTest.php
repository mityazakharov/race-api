<?php

namespace Http\AuthController;

class MeTest extends AuthControllerTest
{
    public function testMe(): void
    {
        $this->json('GET', $this->buildUrl('me'), [], $this->getAuthHeaders())
            ->seeJsonStructure(
                [
                    'result',
                    'data' => [
                        'id',
                        'created_at',
                        'updated_at',
                        'name',
                        'email',
                    ],
                ]
            )
            ->assertResponseOk();
    }
}
