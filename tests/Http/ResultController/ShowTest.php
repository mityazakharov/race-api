<?php

namespace Http\ResultController;

class ShowTest extends ResultControllerTest
{
    public function testShow(): void
    {
        $this->json('GET', $this->buildUrl($this->result->id), [], $this->getAuthHeaders())
            ->seeJsonStructure(
                [
                    'result',
                    'data' => [
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
