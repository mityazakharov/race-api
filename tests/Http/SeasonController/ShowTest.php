<?php

namespace Http\SeasonController;

class ShowTest extends SeasonControllerTest
{
    public function testShow(): void
    {
        $this->json('GET', $this->buildUrl($this->season->id), [], $this->getAuthHeaders())
            ->seeJsonStructure(
                [
                    'result',
                    'data' => [
                        'id',
                        'created_at',
                        'updated_at',
                        'deleted_at',
                        'title',
                        'year_min',
                        'year_max',
                        'is_odd_group',
                    ]
                ]
            )
            ->assertResponseOk();
    }
}
