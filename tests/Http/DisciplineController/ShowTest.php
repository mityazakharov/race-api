<?php

namespace Http\DisciplineController;

class ShowTest extends DisciplineControllerTest
{
    public function testShow(): void
    {
        $this->json('GET', $this->buildUrl($this->discipline->id), [], $this->getAuthHeaders())
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
