<?php

namespace Http\RaceController;

class IndexTest extends RaceControllerTest
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
                            'title',
                            'date_at',
                            'season_id',
                            'stage',
                            'discipline_id',
                            'is_final',
                        ],
                    ],
                ]
            )
            ->assertResponseOk();
    }
}
