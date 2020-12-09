<?php

namespace Http\TeamController;

use App\Models\Team;
use Illuminate\Http\Response;

class StoreTest extends TeamControllerTest
{
    public function testStore(): void
    {
        $params = Team::factory()->make()->only([
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
        $this->teamIds[] = $response['data']['id'];
    }
}
