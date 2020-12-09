<?php

namespace Http\TeamController;

class UpdateTest extends TeamControllerTest
{
    public function testUpdate(): void
    {
        $params = [
            ['title' => 'NEW TITLE'],
        ];

        $this->json('PUT', $this->buildUrl($this->team->id), $params, $this->getAuthHeaders())
            ->seeJsonStructure(
                [
                    'result',
                    'data' => [
                        'id',
                        'created_at',
                        'updated_at',
                        'deleted_at',
                        'title',
                    ]
                ]
            )
            ->assertResponseOk();
    }
}
