<?php

namespace Http\AthleteController;

class IndexTest extends AthleteControllerTest
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
                            'first_name',
                            'last_name',
                            'year',
                            'gender',
                            'team_id',
                            'rate',
                        ],
                    ],
                ]
            )
            ->assertResponseOk();
    }
}
