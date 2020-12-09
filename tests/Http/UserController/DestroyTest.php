<?php

namespace Http\UserController;

use Illuminate\Http\Response;

class DestroyTest extends UserControllerTest
{
    public function testDestroy(): void
    {
        $this->json('DELETE', $this->buildUrl($this->user->id), [], $this->getAuthHeaders())
            ->assertResponseStatus(Response::HTTP_OK);
    }
}
