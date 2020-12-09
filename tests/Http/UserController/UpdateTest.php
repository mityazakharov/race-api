<?php

namespace Http\UserController;

class UpdateTest extends UserControllerTest
{
    public function testUpdate(): void
    {
        $params = [
            ['name' => 'NEW NAME'],
            ['email' => 'NEW.NAME@SITE.NET'],
        ];

        $this->json('PUT', $this->buildUrl($this->user->id), $params, $this->getAuthHeaders())
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
