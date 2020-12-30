<?php

namespace Http\ResultController;

class UpdateTest extends ResultControllerTest
{
    public function testUpdate(): void
    {
        $params = [
            'first_name' => 'TEST',
            'team_id' => $this->team->id,
        ];

        $this->json('PUT', $this->buildUrl($this->athlete->id), $params, $this->getAuthHeaders())
            ->seeJsonStructure(
                [
                    'result',
                    'data' => [
                        'id',
                        'id',
                        'created_at',
                        'updated_at',
                        'race_id',
                        'athlete_id',
                        'team_id',
                        'rate',
                        'group_id',
                        'bib',
                        'run_1',
                        'status_1',
                        'run_2',
                        'status_2',
                        'total',
                        'diff',
                        'place',
                    ]
                ]
            )
            ->assertResponseOk();
    }
}
