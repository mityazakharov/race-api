<?php

namespace Http\TeamController;

use Illuminate\Http\Response;

class DestroyTest extends TeamControllerTest
{
    public function testDestroy(): void
    {
        $this->json('DELETE', $this->buildUrl($this->team->id), [], $this->getAuthHeaders())
            ->assertResponseStatus(Response::HTTP_OK);
    }
}
