<?php

namespace Http\SeasonController;

use Illuminate\Http\Response;

class StoreTest extends SeasonControllerTest
{
    public function testStore(): void
    {
        $params = [
            'title'        => '2013-2014',
            'year_min'     => 2013,
            'year_max'     => 2014,
            'is_odd_group' => true,
        ];

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
                        'is_odd_group',
                    ]
                ]
            )
            ->assertResponseStatus(Response::HTTP_CREATED);

        $response = json_decode($this->response->getContent(), true);
        $this->seasonIds[] = $response['data']['id'];
    }
}
