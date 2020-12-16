<?php

namespace Http\DisciplineController;

class UpdateTest extends DisciplineControllerTest
{
    public function testUpdate(): void
    {
        $params = [
            'title' => 'NEW TITLE',
        ];

        $this->json('PUT', $this->buildUrl($this->discipline->id), $params, $this->getAuthHeaders())
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
