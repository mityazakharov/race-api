<?php

namespace Http\SeasonController;

use Illuminate\Http\Response;

class DestroyTest extends SeasonControllerTest
{
    public function testDestroy(): void
    {
        $this->json('DELETE', $this->buildUrl($this->season->id), [], $this->getAuthHeaders())
            ->assertResponseStatus(Response::HTTP_OK);
    }
}
