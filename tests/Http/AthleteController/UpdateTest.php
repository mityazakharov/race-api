<?php

namespace Http\AthleteController;

class UpdateTest extends AthleteControllerTest
{
    public function testUpdate(): void
    {
        $params = [
            ['team_id' => $this->team->id],
        ];

        $this->json('PUT', $this->buildUrl($this->athlete->id), $params, $this->getAuthHeaders())
            ->seeJsonStructure(
                [
                    'result',
                    'data' => [
                        'id',
                        'created_at',
                        'updated_at',
                        'deleted_at',
                        'first_name',
                        'last_name',
                        'year',
                        'gender',
                        'team_id',
                        'rate',
                    ]
                ]
            )
            ->assertResponseOk();
    }
}
