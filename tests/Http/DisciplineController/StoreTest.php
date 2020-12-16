<?php

namespace Http\DisciplineController;

use App\Models\Discipline;
use Illuminate\Http\Response;

class StoreTest extends DisciplineControllerTest
{
    public function testStore(): void
    {
        $params = Discipline::factory()->make()->only([
            'title',
        ]);

        $this->json('POST', $this->buildUrl(), $params, $this->getAuthHeaders())
            ->seeJsonStructure(
                [
                    'result',
                    'data' => [
                        'id',
                        'created_at',
                        'updated_at',
                        'title',
                    ]
                ]
            )
            ->assertResponseStatus(Response::HTTP_CREATED);

        $response = json_decode($this->response->getContent(), true);
        $this->disciplineIds[] = $response['data']['id'];
    }
}
