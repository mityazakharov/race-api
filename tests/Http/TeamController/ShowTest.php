<?php

namespace Http\TeamController;

class ShowTest extends TeamControllerTest
{
    public function testShow(): void
    {
        $this->json('GET', $this->buildUrl($this->team->id), [], $this->getAuthHeaders())
            ->seeJsonStructure(
                [
                    'result',
                    'data' => [
                        'id',
                        'created_at',
                        'updated_at',
                        'deleted_at',
                        'title',
                    ]
                ]
            )
            ->assertResponseOk();
    }
}
