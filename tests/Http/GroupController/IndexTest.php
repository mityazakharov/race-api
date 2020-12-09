<?php

namespace Http\GroupController;

class IndexTest extends GroupControllerTest
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
                            'gender',
                            'is_odd',
                        ],
                    ],
                ]
            )
            ->assertResponseOk();
    }
}
