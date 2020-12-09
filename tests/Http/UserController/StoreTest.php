<?php

namespace Http\UserController;

use App\Models\User;
use Illuminate\Http\Response;

class StoreTest extends UserControllerTest
{
    public function testStore(): void
    {
        $params = User::factory()->make()->only([
            'name',
            'email',
        ]);

        $this->json('POST', $this->buildUrl(), $params, $this->getAuthHeaders())
            ->seeJsonStructure(
                [
                    'result',
                    'data' => [
                        'id',
                        'created_at',
                        'updated_at',
                        'name',
                        'email',
                    ]
                ]
            )
            ->assertResponseStatus(Response::HTTP_CREATED);

        $response = json_decode($this->response->getContent(), true);
        $this->userIds[] = $response['data']['id'];
    }
}
