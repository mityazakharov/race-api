<?php

namespace Http\GroupController;

use App\Models\Group;
use Illuminate\Http\Response;

class StoreTest extends GroupControllerTest
{
    public function testStore(): void
    {
        $params = Group::factory()->make()->only([
            'title',
            'year_min',
            'year_max',
            'gender',
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
                        'year_min',
                        'year_max',
                        'gender',
                        'is_odd',
                    ]
                ]
            )
            ->assertResponseStatus(Response::HTTP_CREATED);

        $response = json_decode($this->response->getContent(), true);
        $this->groupIds[] = $response['data']['id'];
    }
}
