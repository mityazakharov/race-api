<?php

namespace Http\ResultController;

use App\Models\Result;
use Illuminate\Http\Response;

class StoreTest extends ResultControllerTest
{
    public function testStore(): void
    {
        $params = Result::factory()
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
                        'race_id',
                        'athlete_id',
                        'team_id',
                        'rate',
                        'group_id',
                        'bib',
                        'run_1',
                        'status_1',
                        'run_2',
                        'status_2',
                        'total',
                        'diff',
                        'place',
                    ]
                ]
            )
            ->assertResponseStatus(Response::HTTP_CREATED);

        $response = json_decode($this->response->getContent(), true);
        $this->athleteIds[] = $response['data']['id'];
    }
}
