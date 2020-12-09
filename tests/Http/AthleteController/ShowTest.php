<?php

namespace Http\AthleteController;

class ShowTest extends AthleteControllerTest
{
    public function testShow(): void
    {
        $this->json('GET', $this->buildUrl($this->athlete->id), [], $this->getAuthHeaders())
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
