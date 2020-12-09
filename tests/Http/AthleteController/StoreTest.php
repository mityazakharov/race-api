<?php

namespace Http\AthleteController;

use App\Models\Athlete;
use Illuminate\Http\Response;

class StoreTest extends AthleteControllerTest
{
    public function testStore(): void
    {
        $params = Athlete::factory()
            ->make([
                'team_id' => $this->team->id,
            ])
            ->only([
            'first_name',
            'last_name',
            'year',
            'gender',
            'team_id',
            'rate',
        ]);

        $this->json('POST', $this->buildUrl(), $params, $this->getAuthHeaders())
            ->seeJsonStructure(
                [
                    'result',
                    'data' => [
                        'id',
                        'created_at',
                        'updated_at',
                        'first_name',
                        'last_name',
                        'year',
                        'gender',
                        'team_id',
                        'rate',
                    ]
                ]
            )
            ->assertResponseStatus(Response::HTTP_CREATED);

        $response = json_decode($this->response->getContent(), true);
        $this->athleteIds[] = $response['data']['id'];
    }
}
