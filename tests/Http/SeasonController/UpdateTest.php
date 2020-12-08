<?php

namespace Http\SeasonController;

class UpdateTest extends SeasonControllerTest
{
    public function testUpdate(): void
    {
        $params = [
            ['title' => 'NEW TITLE'],
            ['is_odd_group' => true],
        ];

        $this->json('PUT', $this->buildUrl($this->season->id), $params, $this->getAuthHeaders())
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
                        'is_odd_group',
                    ]
                ]
            )
            ->assertResponseOk();
    }
}
