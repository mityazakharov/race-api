<?php

namespace Http\RaceController;

use Illuminate\Http\Response;

class DestroyTest extends RaceControllerTest
{
    public function testDestroy(): void
    {
        $this->json('DELETE', $this->buildUrl($this->race->id), [], $this->getAuthHeaders())
            ->assertResponseStatus(Response::HTTP_OK);
    }
}
