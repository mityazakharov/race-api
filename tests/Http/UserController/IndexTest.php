<?php

namespace Http\UserController;

class IndexTest extends UserControllerTest
{
    public function testIndex(): void
    {
        $this->json('GET', $this->buildUrl(), [], $this->getAuthHeaders())
            ->seeJsonStructure(
                [
                    'result',
                    'data' => [
                        '*' => [
                            'id',
                            'created_at',
                            'updated_at',
                            'name',
                            'email',
                        ],
                    ],
                ]
            )
            ->assertResponseOk();
    }
}
