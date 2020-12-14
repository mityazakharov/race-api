<?php

namespace Http\AuthController;

use Illuminate\Http\Response;

class RegisterTest extends AuthControllerTest
{
    public function testRegister(): void
    {
        $data = [
            'name'                  => 'John Smith',
            'email'                 => 'john@smith.net',
            'password'              => 'Qwer1234',
            'password_confirmation' => 'Qwer1234',
        ];

        $this->json('POST', $this->buildUrl('register'), $data, $this->getHeaders())
            ->seeJsonStructure(
                [
                    'result',
                    'data' => [
                        'id',
                        'created_at',
                        'updated_at',
                        'name',
                        'email',
                    ],
                ]
            )
            ->assertResponseStatus(Response::HTTP_CREATED);

        $response = json_decode($this->response->getContent(), true);
        $this->userIds[] = $response['data']['id'];
    }
}
