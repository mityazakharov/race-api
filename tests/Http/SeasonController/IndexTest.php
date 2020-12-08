<?php

namespace Http\SeasonController;

class IndexTest extends SeasonControllerTest
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
                            'year_min',
                            'year_max',
                            'is_odd_group',
                        ],
                    ],
                ]
            )
            ->assertResponseOk();
    }
}
