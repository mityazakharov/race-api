<?php

namespace Http\RaceController;

class ShowTest extends RaceControllerTest
{
    public function testShow(): void
    {
        $this->json('GET', $this->buildUrl($this->race->id), [], $this->getAuthHeaders())
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
