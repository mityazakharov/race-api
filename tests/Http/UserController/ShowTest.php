<?php

namespace Http\UserController;

class ShowTest extends UserControllerTest
{
    public function testShow(): void
    {
        $this->json('GET', $this->buildUrl($this->user->id), [], $this->getAuthHeaders())
            ->seeJsonStructure(
                [
                    'result',
                    'data' => [
                        'id',
                        'created_at',
                        'updated_at',
                        'name',
                        'email',
                    ]
                ]
            )
            ->assertResponseOk();
    }
}
