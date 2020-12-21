<?php

namespace Http\RaceController;

use App\Models\Race;
use Illuminate\Http\Response;

class StoreTest extends RaceControllerTest
{
    public function testStore(): void
    {
        $params = Race::factory()
            ->make([
                'season_id'     => $this->season->id,
                'discipline_id' => $this->discipline->id,
            ])
            ->only([
                'title',
                'date_at',
                'season_id',
                'stage',
                'discipline_id',
                'is_final',
            ]);
        $params['date_at'] = $params['date_at']->format('Y-m-d');

        $this->json('POST', $this->buildUrl(), $params, $this->getAuthHeaders())
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
            ->assertResponseStatus(Response::HTTP_CREATED);

        $response = json_decode($this->response->getContent(), true);
        $this->raceIds[] = $response['data']['id'];
    }
}
