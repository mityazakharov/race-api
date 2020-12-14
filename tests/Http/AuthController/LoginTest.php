<?php

namespace Http\AuthController;

class LoginTest extends AuthControllerTest
{
    public function testLogin(): void
    {
        $data = [
            'email'    => $this->user->email,
            'password' => $this->password,
        ];

        $this->json('POST', $this->buildUrl('login'), $data, $this->getHeaders())
            ->seeJsonStructure(
                [
                    'result',
                    'data' => [
                        'token',
                        'token_type',
                        'expires_in',
                    ],
                ]
            )
            ->assertResponseOk();
    }
}
