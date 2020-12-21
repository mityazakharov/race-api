<?php

namespace Http\RaceController;

class UpdateTest extends RaceControllerTest
{
    public function testUpdate(): void
    {
        $params = [
            'title' => 'TEST',
            'final' => true,
        ];

        $this->json('PUT', $this->buildUrl($this->race->id), $params, $this->getAuthHeaders())
            ->seeJsonStructure(
                [
                    'result',
                    'data' => [
                        'id',
                        'created_at',
                        'updated_at',
                        'title',
                        'date_at',
                        'season_id',
                        'stage',
                        'discipline_id',
                        'is_final',
                    ]
                ]
            )
            ->assertResponseOk();
    }
}
