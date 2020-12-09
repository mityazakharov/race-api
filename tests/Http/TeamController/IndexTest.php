<?php

namespace Http\TeamController;

class IndexTest extends TeamControllerTest
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
                            'deleted_at',
                            'title',
                        ],
                    ],
                ]
            )
            ->assertResponseOk();
    }
}
