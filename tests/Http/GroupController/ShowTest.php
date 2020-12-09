<?php

namespace Http\GroupController;

class ShowTest extends GroupControllerTest
{
    public function testShow(): void
    {
        $this->json('GET', $this->buildUrl($this->group->id), [], $this->getAuthHeaders())
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
                        'gender',
                        'is_odd',
                    ]
                ]
            )
            ->assertResponseOk();
    }
}
