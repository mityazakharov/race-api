<?php

namespace Http\GroupController;

class UpdateTest extends GroupControllerTest
{
    public function testUpdate(): void
    {
        $params = [
            'title' => 'NEW TITLE',
            'gender' => 'W',
        ];

        $this->json('PUT', $this->buildUrl($this->group->id), $params, $this->getAuthHeaders())
            ->seeJsonStructure(
                [
                    'result',
                    'data' => [
                        'id',
                        'created_at',
                        'updated_at',
                        'deleted_at',
                        'title',
                        'year_min',
                        'year_max',
                        'gender',
                        'is_odd',
                    ]
                ]
            )
            ->assertResponseOk();
    }
}
